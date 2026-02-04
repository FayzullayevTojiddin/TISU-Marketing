<?php

namespace App\Services;

use App\Models\StudentContract;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\TemplateProcessor;

class ContractGenerateService
{
    public function generate(StudentContract $contract): void
    {
        $templatePath = storage_path(
            'app/private/' . ltrim($contract->contractType->base_file_path, '/')
        );

        if (! file_exists($templatePath)) {
            throw new \RuntimeException(
                'Template not found: ' . $templatePath
            );
        }

        $processor = new TemplateProcessor($templatePath);

        foreach ($contract->data as $item) {
            $processor->setValue(
                $item['key'],
                $item['value'] ?? ''
            );
        }

        $fileName = 'contract_' . $contract->id . '.docx';
        $directory = storage_path('app/contracts');

        if (! File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $outputPath = $directory . '/' . $fileName;

        $processor->saveAs($outputPath);

        $contract->update([
            'file_path' => 'contracts/' . $fileName,
        ]);
    }
}
