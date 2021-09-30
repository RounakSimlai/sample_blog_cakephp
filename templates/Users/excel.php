<?php

use App\Model\Entity\User;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

/**
 * @var User $user
 */

$spreadsheet = new Spreadsheet();
// Add data in that file
$spreadsheet->getActiveSheet()
    ->setCellValue('A1', 'ID')
    ->setCellValue('B1', 'First Name')
    ->setCellValue('C1', 'Last Name')
    ->setCellValue('D1', 'Email')
    ->setCellValue('E1', 'Role ID')
    ->setCellValue('F1', 'Created')
    ->setCellValue('G1', 'Modified')
    ->setCellValue('H1', 'Profile Picture')
    ->setCellValue('A2', $user->id)
    ->setCellValue('B2', $user->first_name)
    ->setCellValue('C2', $user->last_name)
    ->setCellValue('D2', $user->email)
    ->setCellValue('E2', $user->role_id)
    ->setCellValue('F2', $user->created)
    ->setCellValue('G2', $user->modified);

$path = WWW_ROOT . 'img' . DS;
$drawing = new Drawing();
$drawing
    ->setPath($path . $user->image)
    ->setCoordinates('H2')
    ->setWidth(100)
    ->setHeight(100)
    ->setWorksheet($spreadsheet->getActiveSheet());


// Save the data in a stream
$writer = new Xlsx($spreadsheet);
try {
    $writer->save('php://output');
} catch (\PhpOffice\PhpSpreadsheet\Writer\Exception $e) {
    dd($e->getMessage());
}
