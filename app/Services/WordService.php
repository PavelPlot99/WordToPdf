<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Settings;

class WordService
{
    public TemplateProcessor $word_template;

    public function __construct(String $file)
    {
        Settings::setPdfRendererName(Settings::PDF_RENDERER_DOMPDF);
        Settings::setPdfRendererPath($_SERVER['DOCUMENT_ROOT'].'/../vendor/dompdf/dompdf');
        $this->word_template = new TemplateProcessor($file);
    }

    public static function generate($file, String $firstname):string
    {
        $word = new self($file);
        $word->changeValues($firstname);

        return $word->saveAsPdf();
    }

    public function changeValues($firstname):void
    {
        $this->word_template->setValue('firstname', $firstname);
    }

    public function saveAsPdf():string
    {
        $filename = Carbon::now()->format('His');

        $filepath = Storage::disk('public')->path($filename.'.docx');
        $filepath_pdf = Storage::disk('public')->path($filename.'.pdf');

        $this->word_template->saveAs($filepath);

        $phpWord = IOFactory::load($filepath);
        $phpWord->save($filepath_pdf, "PDF");

        return $filename.'.pdf';
    }
}
