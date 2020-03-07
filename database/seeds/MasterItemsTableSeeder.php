<?php

use App\MasterItem;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MasterItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MasterItem::truncate();
        ini_set('auto_detect_line_endings', true);
        $file_obj = new \SplFileObject(storage_path('app/csv/sample_lesson.csv'));
        
        //SplFileObjectによって使われるフラグをセット
        $file_obj->setFlags(
            \SplFileObject::READ_CSV |          // CSV 列として行を読む込む
            \SplFileObject::READ_AHEAD |        // 先読み/巻き戻しで読み出す
            \SplFileObject::SKIP_EMPTY          // 空行は読み飛ばす
        );

        $no = 0;
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
}
