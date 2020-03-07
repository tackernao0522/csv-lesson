<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportCsvController extends Controller
{   // 作成してあるCSVデータファイルから読み込みテキストファイルを生成してそれに読み込む
    public function read_csv()
    {
        // win mac両方対応の改行の意味
        ini_set('auto_detect_line_endings', true);
        // インプットのCSVのオブジェクトを生成する
        $file_obj = new \SplFileObject(storage_path('app/csv/sample_lesson.csv'));
        // SplFileObjectによって使われるフラグをセット
        $file_obj->setFlags(
            \SplFileObject::READ_CSV |          // CSV 列として行を読み込む
            \SplFileObject::READ_AHEAD |        // 先読み/巻き戻しで読み出す
            \SplFileObject::SKIP_EMPTY          // 行末の改行を読み飛ばす
        );

        // ファイルを開く
        $file_data = fopen('test.txt', 'w');    // ループ前にファイルを開いておく

        $no = 1;
        foreach ($file_obj as $row) {
            echo "[".$no."]".PHP_EOL;
            // SJISからUTF-8に変換
            $row = mb_convert_encoding($row, "UTF-8", "SJIS");
            var_dump($row);
            echo PHP_EOL;
            $no++;

            // csvの行数分だけファイルに書き込みをする
            fwrite($file_data, "{$row[0]}"."     ");
            fwrite($file_data, "{$row[1]}"."     ");
            fwrite($file_data, "{$row[2]}"."     ");
            fwrite($file_data, "{$row[3]}"."     ");
            fwrite($file_data, "{$row[4]}"."     ");
            fwrite($file_data, "{$row[5]}"."     ");
            fwrite($file_data, "{$row[6]}"."     ");
            fwrite($file_data, "{$row[7]}"."     ");
            fwrite($file_data, "{$row[8]}"."     ");
            fwrite($file_data, "{$row[9]}"."     ");
            fwrite($file_data, "{$row[10]}"."     ");
            fwrite($file_data, "{$row[11]}"."     ");
            fwrite($file_data, "{$row[12]}"."     ");
            fwrite($file_data, "{$row[13]}"."     ");
            fwrite($file_data, "{$row[14]}"."     ");
            fwrite($file_data, "{$row[15]}"."     ");
            fwrite($file_data, "{$row[16]}"."     ");
            fwrite($file_data, "{$row[17]}"."     ");
            fwrite($file_data, "{$row[18]}"."     ");
            fwrite($file_data, "{$row[19]}"."     ");
            fwrite($file_data, "{$row[20]}"."     ");
            fwrite($file_data, "{$row[21]}".PHP_EOL);
        }
        // 全て書き込み終わったのでファイルを閉じる 注: foreachでループが終わった後
        fclose($file_data);
    }
}
