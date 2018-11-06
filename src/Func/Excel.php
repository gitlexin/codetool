<?php

namespace Lexin\Func;

class Excel
{
    /**
     * 将Excel内容完整的读取成数组
     * @param  string $filePath excel路径
     * @return array
     */
    public static function read_excel($filePath)
    {
        if (!is_file($filePath)) {
            return [];
        }

        $inputFileType = \PHPExcel_IOFactory::identify($filePath);
        $PHPReader     = \PHPExcel_IOFactory::createReader($inputFileType);
        //只读去数据，忽略里面各种格式等(对于Excel读取，有很大优化)
        // $PHPReader->setReadDataOnly(true);

        $PHPExcel = $PHPReader->load($filePath);
        /**读取excel文件中的第一个工作表*/
        $currentSheet = $PHPExcel->getSheet(0);
        /**取得最大的列号*/
        $allColumn = $currentSheet->getHighestColumn();
        /**取得一共有多少行*/
        $allRow = $currentSheet->getHighestRow();
        /**从第一行开始 全部原封不动读取返回*/
        $result = [];

        for ($currentRow = 1; $currentRow <= $allRow; $currentRow++) {
            /**从第A列开始输出*/
            for ($currentColumn = 'A'; $currentColumn <= $allColumn; $currentColumn++) {
                $cell = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65, $currentRow);
                $val  = $cell->getValue();


                //如果是时间格式，则解析
                if ($cell->getDataType() == \PHPExcel_Cell_DataType::TYPE_NUMERIC) {
                    $cellstyleformat = $currentSheet->getStyle($cell->getCoordinate())->getNumberFormat();
                    $formatcode      = $cellstyleformat->getFormatCode();
                    if (preg_match('/^($[A−Z]*−[0−9A−F]*)*[hmsdy]/i', $formatcode)) {
                        $val = gmdate("Y-m-d", \PHPExcel_Shared_Date::ExcelToPHP($val));
                    } else {
                        $val = \PHPExcel_Style_NumberFormat::toFormattedString($val, $formatcode);
                    }
                    if (is_object($val)) {
                        $val = $val->__toString();
                    }
                }
                $result[$currentRow][] = (string) $val;
            }
            //如果整行都是空数据 删除该行
            if (empty(array_filter($result[$currentRow]))) {
                unset($result[$currentRow]);
            }
        }
        return $result;
    }
}
