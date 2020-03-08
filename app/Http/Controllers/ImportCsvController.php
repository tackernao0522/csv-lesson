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

        $header = ['Combination ID', 'Purin', 'Chocolate', 'Fresh Berries', 'Raisins', 'Pineapple', 'Vanilla Ice Cream', 'Brown Rice', 'Roasted Soybeans', 'Coconut', 'Honey', 'Miso', 'Personal FlavorPrint File name', 'Personal Top Flavor 1', 'Personal Top Flavor 2', 'Personal Top Flavor 3', 'Recommendation 1 ID', 'Recommendation 1 Compatibility', 'Recommendation 2 ID', 'Recommendation 2 Compatibility'];
        fputcsv($fp, $header);

        for ($i = 0; $i < 8850; $i++) {
            $big_items1  = [1,1,1,1,1,1,1,1,1,1,1,1,  '1.png',1,2,3,5,82, 8,64];
            $big_items2  = [2,1,1,1,1,1,1,1,1,1,1,2,  '2.png',1,2,4,5,88,16,72];
            $big_items3  = [3,1,1,1,1,1,1,1,1,1,1,3,  '3.png',1,2,4,5,93,16,79];
            $big_items4  = [4,1,1,1,1,1,1,1,1,1,2,1,  '4.png',1,3,3,5,87,16,73];
            $big_items5  = [5,1,1,1,1,1,1,1,1,1,2,2,  '5.png',1,2,3,5,93,16,82];
            $big_items6  = [6,1,1,1,1,1,1,1,1,1,2,3,  '6.png',1,2,3,5,96,16,88];
            $big_items7  = [7,1,1,1,1,1,1,1,1,1,3,1,  '7.png',1,3,2,5,91,16,83];
            $big_items8  = [8,1,1,1,1,1,1,1,1,1,3,2,  '8.png',1,3,2,5,95,16,90];
            $big_items9  = [9,1,1,1,1,1,1,1,1,1,3,3,  '9.png',1,2,3,5,98,16,93];
            $big_items10 =[10,1,1,1,1,1,1,1,1,2,1,1, '10.png',1,2,5,5,86,18,70];
            $big_items11 =[11,1,1,1,1,1,1,1,1,2,1,2, '11.png',1,2,4,5,91,16,79];
            $big_items12 =[12,1,1,1,1,1,1,1,1,2,1,3, '12.png',1,2,4,5,95,16,85];
            $big_items13 =[13,1,1,1,1,1,1,1,1,2,2,1, '13.png',1,3,3,5,90,16,80];
            $big_items14 =[14,1,1,1,1,1,1,1,1,2,2,2, '14.png',1,2,3,5,95,16,87];
            $big_items15 =[15,1,1,1,1,1,1,1,1,2,2,3, '15.png',1,2,6,5,98,16,91];
            $big_items16 =[16,1,1,1,1,1,1,1,1,2,3,1, '16.png',1,3,7,5,93,16,87];
            $big_items17 =[17,1,1,1,1,1,1,1,1,2,3,2, '17.png',1,3,2,5,97,16,92];
            $big_items18 =[18,1,1,1,1,1,1,1,1,2,3,3, '18.png',1,6,2,5,99,16,95];
            $big_items19 =[19,1,1,1,1,1,1,1,1,3,1,1, '19.png',1,5,2,5,88,12,76];
            $big_items20 =[20,1,1,1,1,1,1,1,1,3,1,2, '20.png',1,5,2,5,93,16,82];

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
            $master_item->id = $row[0];
            $master_item->q01 = $row[1];
            $master_item->q02 = $row[2];
            $master_item->q03 = $row[3];
            $master_item->q04 = $row[4];
            $master_item->q05 = $row[5];
            $master_item->q06 = $row[6];
            $master_item->q07 = $row[7];
            $master_item->q08 = $row[8];
            $master_item->q09 = $row[9];
            $master_item->q10 = $row[10];
            $master_item->q11 = $row[11];
            $master_item->fp_img = $row[12];
            $master_item->flavor_id1 = $row[13];
            $master_item->flavor_id2 = $row[14];
            $master_item->flavor_id3 = $row[15];
            $master_item->recommend_item_id1 = $row[16];
            // $master_item->recommendation_1_title = $row[17];
            $master_item->compatibility1 = $row[17];
            $master_item->recommend_item_id2 = $row[18];
            // $master_item->recommendation_2_title = $row[20];
            $master_item->compatibility2 = $row[19];
            
            DB::table('master_items')->insert(
                [
                    'id' => $row[0],
                    'q01' => $row[1],
                    'q02' => $row[2],
                    'q03' => $row[3],
                    'q04' => $row[4],
                    'q05' => $row[5],
                    'q06' => $row[6],
                    'q07' => $row[7],
                    'q08' => $row[8],
                    'q09' => $row[9],
                    'q10' => $row[10],
                    'q11' => $row[11],
                    'fp_img' => $row[12],
                    'flavor_id1' => $row[13],
                    'flavor_id2' => $row[14],
                    'flavor_id3' => $row[15],
                    'recommend_item_id1' => $row[16],
                    // 'recommendation_1_title' => $row[17],
                    'compatibility1' => $row[17],
                    'recommend_item_id2' => $row[18],
                    // 'recommendation_2_title' => $row[20],
                    'compatibility2' => $row[19],
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
