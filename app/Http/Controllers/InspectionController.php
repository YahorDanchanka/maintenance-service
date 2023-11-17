<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use PhpOffice\PhpWord\TemplateProcessor;

class InspectionController extends Controller
{
    public function print(Inspection $inspection)
    {
        $templateProcessor = new TemplateProcessor(resource_path('documents/inspection.docx'));

        $templateProcessor->setValues([...$inspection->getAttributes(), 'expert' => $inspection->expert->full_name]);

        $tempFile = tempnam(sys_get_temp_dir(), 'phpword');
        $templateProcessor->saveAs($tempFile);

        return response()
            ->download($tempFile, "Тех осмотр №{$inspection->id}.docx")
            ->deleteFileAfterSend();
    }
}
