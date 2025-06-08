<?php

// Interface para implementação do processamento de arquivos
interface FileProcessorInterface {
    public function processFile(string $filename): void;
}

// Implementação concreta para arquivos de texto
class TextFileProcessor implements FileProcessorInterface {
    public function processFile(string $filename): void {
        echo "Processando arquivo de texto: $filename\n";
        // Simulação de processamento
        echo "Lendo conteúdo do arquivo de texto...\n";
    }
}

// Implementação concreta para arquivos PDF
class PdfFileProcessor implements FileProcessorInterface {
    public function processFile(string $filename): void {
        echo "Processando arquivo PDF: $filename\n";
        // Simulação de processamento
        echo "Extraindo texto do arquivo PDF...\n";
    }
}

// Abstração que usa a implementação
abstract class FileProcessor {
    protected FileProcessorInterface $processor;

    public function __construct(FileProcessorInterface $processor) {
        $this->processor = $processor;
    }

    abstract public function process(string $filename): void;
}

// Abstração refinada que pode adicionar funcionalidades extras
class AdvancedFileProcessor extends FileProcessor {
    public function process(string $filename): void {
        echo "Iniciando processamento avançado...\n";
        $this->processor->processFile($filename);
        echo "Processamento avançado concluído.\n\n";
    }
}

// Código cliente
$textProcessor = new AdvancedFileProcessor(new TextFileProcessor());
$pdfProcessor = new AdvancedFileProcessor(new PdfFileProcessor());

$textProcessor->process("documento.txt");
$pdfProcessor->process("relatorio.pdf");

?>
