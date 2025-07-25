<?php
require 'vendor/autoload.php'; // or your manual path

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$file = "submission.xlsx";

$data = [
    $_POST['emp_code'],
    $_POST['emp_name'],
    $_POST['uniform'],
    $_POST['region'],
    $_POST['store'],
    $_POST['qty']
];

// Load existing or create new file
if (file_exists($file)) {
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $row = $sheet->getHighestRow() + 1;
} else {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->fromArray(["Emp Code", "Name", "Uniform", "Region", "Store", "Qty"], NULL, "A1");
    $row = 2;
}

$sheet->fromArray($data, NULL, "A$row");

$writer = new Xlsx($spreadsheet);
$writer->save($file);

echo "✔️ Data saved to Excel. <a href='index.html'>Back to form</a>";
