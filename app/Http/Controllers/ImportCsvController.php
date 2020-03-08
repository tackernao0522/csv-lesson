<?php

namespace App\Http\Controllers;

use App\MasterItem;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ImportCsvController extends Controller
{   // 作成したCSVファイルを読み込みDBへ登録
    public function import_db()
    {
        // リロードする都度にdbデータ全削除
        MasterItem::truncate();
        // win mac両方対応の改行の意味
        ini_set('auto_detect_line_endings', true);
        // インプットのCSVのオブジェクトを生成
        $file_obj = new \SplFileObject(storage_path('app/csv/sample_lesson.csv'));
        //SplFileObjectによって使われるフラグをセット
        $file_obj->setFlags(
            \SplFileObject::READ_CSV |          // CSV 列として行を読む込む
            \SplFileObject::READ_AHEAD |        // 先読み/巻き戻しで読み出す
            \SplFileObject::SKIP_EMPTY          // 空行は読み飛ばす
        );

        $no=0;
        $master_item = new MasterItem();
        foreach ($file_obj as $row) {
            $no++;
            echo "[".$no."]".PHP_EOL;
            $row = mb_convert_encoding($row, "UTF-8", "SJIS");
            // \Log::info('instance of row' . $row[0]);
            // ヘッダーの1行目を飛ばす
            if ( $no == 1 ) {
                continue;
            }
            var_dump($row);
            echo PHP_EOL;
            $master_item->combination_id = $row[0];
            $master_item->prin = $row[1];
            $master_item->chocolate = $row[2];
            $master_item->fresh_berries = $row[3];
            $master_item->raisins = $row[4];
            $master_item->pineapple = $row[5];
            $master_item->vanilla_ice_cream = $row[6];
            $master_item->brown_rice = $row[7];
            $master_item->roasted_soybeans = $row[8];
            $master_item->coconut = $row[9];
            $master_item->honey = $row[10];
            $master_item->miso = $row[11];
            $master_item->personal_flavor_print_file_name = $row[12];
            $master_item->personal_top_flavor_1 = $row[13];
            $master_item->personal_top_flavor_2 = $row[14];
            $master_item->personal_top_flavor_3 = $row[15];
            $master_item->recommendation_1_id = $row[16];
            $master_item->recommendation_1_title = $row[17];
            $master_item->recommendation_1_compatibillity = $row[18];
            $master_item->recommendation_2_id = $row[19];
            $master_item->recommendation_2_title = $row[20];
            $master_item->recommendation_2_compatibility = $row[21];
            
            DB::table('master_items')->insert(
                [
                    'combination_id' => $row[0],
                    'prin' => $row[1],
                    'chocolate' => $row[2],
                    'fresh_berries' => $row[3],
                    'raisins' => $row[4],
                    'pineapple' => $row[5],
                    'vanilla_ice_cream' => $row[6],
                    'brown_rice' => $row[7],
                    'roasted_soybeans' => $row[8],
                    'coconut' => $row[9],
                    'honey' => $row[10],
                    'miso' => $row[11],
                    'personal_flavor_print_file_name' => $row[12],
                    'personal_top_flavor_1' => $row[13],
                    'personal_top_flavor_2' => $row[14],
                    'personal_top_flavor_3' => $row[15],
                    'recommendation_1_id' => $row[16],
                    'recommendation_1_title' => $row[17],
                    'recommendation_1_compatibillity' => $row[18],
                    'recommendation_2_id' => $row[19],
                    'recommendation_2_title' => $row[20],
                    'recommendation_2_compatibility' => $row[21],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            );
        }
    }

    // 大量データCSV作成
    public function create_csv()
    {   
        $fp = fopen('big_data.csv', 'w');

        $header = ['combination_id', 'prin', 'chocolate', 'fresh_berries', 'raisins', 'pineapple', 'vanilla_ice_cream', 'brown_rice', 'roasted_soybeans', 'coconut', 'honey', 'miso', 'personal_flavor_print_file_name', 'personal_top_flavor_1', 'personal_top_flavor_2', 'personal_top_flavor_3', 'recommendation_1_id', 'recommendation_1_title', 'recommendation_1_compatibillity', 'recommendation_2_id', 'recommendation_2_title', 'recommendation_2_compatibility'];
        fputcsv($fp, $header);

        for ($i = 0; $i < 8850; $i++) {
            $big_items1 = [1,1,1,1,1,1,1,1,1,1,1,1,'1.png','Sweet','Starchy','Toasted','CCC05','フルーツグラノラ  朝摘みいちご',82,'CCC08','ハーシー  とろけるチョコレート    袋',64];
            $big_items2 = [2,1,1,1,1,1,1,1,1,1,1,2,'2.png','Sweet','Starchy','Bitter','CCC05','フルーツグラノラ  朝摘みいちご',88,'CCC16','ハーシー  チョコビッツ    ミルキークリーム',72];
            $big_items3 = [3,1,1,1,1,1,1,1,1,1,1,3,'3.png','Sweet','Starchy','Bitter','CCC05','フルーツグラノラ  朝摘みいちご',93,'CCC16','ハーシー  チョコビッツ    ミルキークリーム',79];
            $big_items4 = [4,1,1,1,1,1,1,1,1,1,2,1,'4.png','Sweet','Toasted','Toasted','CCC05','フルーツグラノラ  朝摘みいちご',87,'CCC16','ハーシー  チョコビッツ    ミルキークリーム',73];
            $big_items5 = [5,1,1,1,1,1,1,1,1,1,2,2,'5.png','Sweet','Starchy','Toasted','CCC05','フルーツグラノラ  朝摘みいちご',93,'CCC16','ハーシー  チョコビッツ    ミルキークリーム',82];
            $big_items6 = [6,1,1,1,1,1,1,1,1,1,2,3,'6.png','Sweet','Starchy','Toasted','CCC05','フルーツグラノラ  朝摘みいちご',96,'CCC16','ハーシー  チョコビッツ    ミルキークリーム',88];
            $big_items7 = [7,1,1,1,1,1,1,1,1,1,3,1,'7.png','Sweet','Toasted','Starchy','CCC05','フルーツグラノラ  朝摘みいちご',91,'CCC16','ハーシー  チョコビッツ    ミルキークリーム',83];
            $big_items8 = [8,1,1,1,1,1,1,1,1,1,3,2,'8.png','Sweet','Toasted','Starchy','CCC05','フルーツグラノラ  朝摘みいちご',95,'CCC16','ハーシー  チョコビッツ    ミルキークリーム',90];
            $big_items9 = [9,1,1,1,1,1,1,1,1,1,3,3,'8.png','Sweet','Starchy','Toasted','CCC05','フルーツグラノラ  朝摘みいちご',98,'CCC16','ハーシー  チョコビッツ    ミルキークリーム',93];
            $big_items10 = [10,1,1,1,1,1,1,1,1,2,1,1,'9.png','Sweet','Starchy','Tropical','CCC05','フルーツグラノラ  朝摘みいちご',86,'CCC18','ふわサクフルーツ&ナッツグラノーラ',70];
            $big_items11 = [11,1,1,1,1,1,1,1,1,2,1,2,'10.png','Sweet','Starchy','Bitter','CCC05','フルーツグラノラ  朝摘みいちご',91,'CCC16','ハーシー  チョコビッツ    ミルキークリーム',79];
            $big_items12 = [12,1,1,1,1,1,1,1,1,2,1,3,'11.png','Sweet','Starchy','Bitter','CCC05','フルーツグラノラ  朝摘みいちご',95,'CCC16','ハーシー  チョコビッツ    ミルキークリーム',85];
            $big_items13 = [13,1,1,1,1,1,1,1,1,2,2,1,'12.png','Sweet','Toasted','Toasted','CCC05','フルーツグラノラ  朝摘みいちご',90,'CCC16','ハーシー  チョコビッツ    ミルキークリーム',80];
            $big_items14 = [14,1,1,1,1,1,1,1,1,2,2,2,'13.png','Sweet','Starchy','Toasted','CCC05','フルーツグラノラ  朝摘みいちご',95,'CCC16','ハーシー  チョコビッツ    ミルキークリーム',87];
            $big_items15 = [15,1,1,1,1,1,1,1,1,2,2,3,'14.png','Sweet','Starchy','Fruity','CCC05','フルーツグラノラ  朝摘みいちご',98,'CCC16','ハーシー  チョコビッツ    ミルキークリーム',91];
            $big_items16 = [16,1,1,1,1,1,1,1,1,2,3,1,'15.png','Sweet','Toasted','Caramelized','CCC05','フルーツグラノラ  朝摘みいちご',93,'CCC16','ハーシー  チョコビッツ    ミルキークリーム',87];
            $big_items17 = [17,1,1,1,1,1,1,1,1,2,3,2,'16.png','Sweet','Toasted','Starchy','CCC05','フルーツグラノラ  朝摘みいちご',97,'CCC16','ハーシー  チョコビッツ    ミルキークリーム',92];
            $big_items18 = [18,1,1,1,1,1,1,1,1,2,3,3,'17.png','Sweet','Fruity','Starchy','CCC05','フルーツグラノラ  朝摘みいちご',99,'CCC16','ハーシー  チョコビッツ    ミルキークリーム',95];
            $big_items19 = [19,1,1,1,1,1,1,1,1,3,1,1,'18.png','Sweet','Tropical','Starchy','CCC05','フルーツグラノラ  朝摘みいちご',88,'CCC12','フルーツグラノラ    ハーフ',76];
            $big_items20 = [20,1,1,1,1,1,1,1,1,3,1,2,'19.png','Sweet','Tropical','Starchy','CCC05','フルーツグラノラ  朝摘みいちご',93,'CCC16','ハーシー  チョコビッツ    ミルキークリーム',82];

            fputcsv($fp, $big_items1);
            fputcsv($fp, $big_items2);
            fputcsv($fp, $big_items3);
            fputcsv($fp, $big_items4);
            fputcsv($fp, $big_items5);
            fputcsv($fp, $big_items6);
            fputcsv($fp, $big_items7);
            fputcsv($fp, $big_items8);
            fputcsv($fp, $big_items9);
            fputcsv($fp, $big_items10);
            fputcsv($fp, $big_items11);
            fputcsv($fp, $big_items12);
            fputcsv($fp, $big_items13);
            fputcsv($fp, $big_items14);
            fputcsv($fp, $big_items15);
            fputcsv($fp, $big_items16);
            fputcsv($fp, $big_items17);
            fputcsv($fp, $big_items18);
            fputcsv($fp, $big_items19);
            fputcsv($fp, $big_items20);
        }
        fclose($fp);
    }

    public function big_import()
    {
        // リロードする都度にdbデータ全削除
        MasterItem::truncate();
        $start_time = date('Y/m/d H:i:s');
        \Log::info('start : ' . $start_time);
        // win mac両方対応の改行の意味
        ini_set('auto_detect_line_endings', true);
        // インプットのCSVのオブジェクトを生成
        $file_obj = new \SplFileObject(public_path('big_data.csv'));
        //SplFileObjectによって使われるフラグをセット
        $file_obj->setFlags(
            \SplFileObject::READ_CSV |          // CSV 列として行を読む込む
            \SplFileObject::READ_AHEAD |        // 先読み/巻き戻しで読み出す
            \SplFileObject::SKIP_EMPTY          // 空行は読み飛ばす
        );

        $no=0;
        $master_item = new MasterItem();
        DB::beginTransaction();
        foreach ($file_obj as $row) {
            $no++;
            // echo "[".$no."]".PHP_EOL;
            // \Log::info('instance of row' . $row[0]);
            // ヘッダーの1行目を飛ばす
            if ( $no == 1 ) {
                continue;
            }
            // var_dump($row);
            echo PHP_EOL;
            $master_item->combination_id = $row[0];
            $master_item->prin = $row[1];
            $master_item->chocolate = $row[2];
            $master_item->fresh_berries = $row[3];
            $master_item->raisins = $row[4];
            $master_item->pineapple = $row[5];
            $master_item->vanilla_ice_cream = $row[6];
            $master_item->brown_rice = $row[7];
            $master_item->roasted_soybeans = $row[8];
            $master_item->coconut = $row[9];
            $master_item->honey = $row[10];
            $master_item->miso = $row[11];
            $master_item->personal_flavor_print_file_name = $row[12];
            $master_item->personal_top_flavor_1 = $row[13];
            $master_item->personal_top_flavor_2 = $row[14];
            $master_item->personal_top_flavor_3 = $row[15];
            $master_item->recommendation_1_id = $row[16];
            $master_item->recommendation_1_title = $row[17];
            $master_item->recommendation_1_compatibillity = $row[18];
            $master_item->recommendation_2_id = $row[19];
            $master_item->recommendation_2_title = $row[20];
            $master_item->recommendation_2_compatibility = $row[21];
            
            DB::table('master_items')->insert(
                [
                    'combination_id' => $row[0],
                    'prin' => $row[1],
                    'chocolate' => $row[2],
                    'fresh_berries' => $row[3],
                    'raisins' => $row[4],
                    'pineapple' => $row[5],
                    'vanilla_ice_cream' => $row[6],
                    'brown_rice' => $row[7],
                    'roasted_soybeans' => $row[8],
                    'coconut' => $row[9],
                    'honey' => $row[10],
                    'miso' => $row[11],
                    'personal_flavor_print_file_name' => $row[12],
                    'personal_top_flavor_1' => $row[13],
                    'personal_top_flavor_2' => $row[14],
                    'personal_top_flavor_3' => $row[15],
                    'recommendation_1_id' => $row[16],
                    'recommendation_1_title' => $row[17],
                    'recommendation_1_compatibillity' => $row[18],
                    'recommendation_2_id' => $row[19],
                    'recommendation_2_title' => $row[20],
                    'recommendation_2_compatibility' => $row[21],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            );
        }
        DB::commit();
        $end_time = date('Y/m/d H:i:s');
        \Log::info('finish : ' . $end_time);
        $fromSec = strtotime($start_time);
        $toSec = strtotime($end_time);
        $differences = $toSec - $fromSec;
        $result = gmdate("H:i:s", $differences);
        \Log::info('difference : ' . $result);
    }

    // 作成してあるCSVデータファイルから読み込みテキストファイルを生成してそれに読み込む
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
        $file_data = fopen('sample_lesson.txt', 'w');    // ループ前にファイルを開いておく

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
