<?php

namespace App\Http\Controllers;

use App\Models\Act;
use App\Models\Material;
use PhpOffice\PhpWord\TemplateProcessor;

class ActController extends Controller
{
    public function print(Act $act)
    {
        $materials = $act->service->materials;
        $templateProcessor = new TemplateProcessor(resource_path('documents/act.docx'));

        $templateProcessor->setValues([
            ...$act->getAttributes(),
            'service' => $act->service->name,
            'expert' => $act->expert->full_name,
        ]);

        $templateProcessor->cloneRowAndSetValues(
            'material_name',
            array_map(
                fn($material) => [
                    'material_name' => $material['name'],
                    'material_count' => $material['pivot']['count'],
                ],
                $materials->toArray()
            )
        );

        $tempFile = tempnam(sys_get_temp_dir(), 'phpword');
        $templateProcessor->saveAs($tempFile);

        return response()
            ->download($tempFile, "{$act->name}.docx")
            ->deleteFileAfterSend();
    }
}
