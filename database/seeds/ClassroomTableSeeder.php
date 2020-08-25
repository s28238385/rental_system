<?php

use Illuminate\Database\Seeder;

use App\Classroom;

class ClassroomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Classroom = new Classroom([
            'classroomName' => 'I_314',
            'imagePath' => '/img/classroom/I_314.jpg',
            'equipmentDescription' => 
                '座位數：17-28。
                基本設備：筆記型電腦(含網路)、投影機、麥克風、冷氣。
                網路：無線網路。
                聲音輸入：講桌3.5音源輸入。
                顯示訊號輸入：VGA。'
        ]);
        $Classroom -> save();

        $Classroom = new Classroom([
            'classroomName' => 'I_315',
            'imagePath' => '/img/classroom/I_315.jpg',
            'equipmentDescription' => 
                '座位數：34。
                基本設備：筆記型電腦(含網路)、投影機、麥克風、冷氣。
                網路：網路孔、無線網路。
                聲音輸入：講桌3.5音源輸入。
                顯示訊號輸入：VGA。'
        ]);
        $Classroom -> save();

        $Classroom = new Classroom([
            'classroomName' => 'I_726',
            'imagePath' => '/img/classroom/I_726.jpg',
            'equipmentDescription' => 
                '基本設備：高畫質內投影顯示器、冷氣。
                網路：無線網路。
                聲音輸入：無。
                顯示訊號輸入：HDMI。

                ※備註：本教室無麥克風。'
        ]);
        $Classroom -> save();

        $Classroom = new Classroom([
            'classroomName' => 'I1_002',
            'imagePath' => '/img/classroom/I1_002.jpg',
            'equipmentDescription' => 
                '座位數：54。
                基本設備：筆記型電腦(含網路)、投影機、麥克風、冷氣。
                網路：網路孔、無線網路。
                聲音輸入：講桌3.5音源輸入。
                顯示訊號輸入：VGA。'
        ]);
        $Classroom -> save();

        $Classroom = new Classroom([
            'classroomName' => 'I1_017',
            'imagePath' => '/img/classroom/I1_017.jpg',
            'equipmentDescription' => 
                '座位數：138-144。
                基本設備：筆記型電腦(含網路)、投影機、麥克風、冷氣。
                網路：無線網路。
                聲音輸入：講桌3.5音源輸入。
                顯示訊號輸入：VGA、HDMI。
                
                ※備註：139-144之座位需自行搬活動椅。'
        ]);
        $Classroom -> save();

        $Classroom = new Classroom([
            'classroomName' => 'I1_105',
            'imagePath' => '/img/classroom/I1_105.jpg',
            'equipmentDescription' => 
                '座位數：80。
                基本設備：筆記型電腦(含網路)、投影機、麥克風、冷氣。
                網路：無線網路。
                聲音輸入：講桌3.5音源輸入。
                顯示訊號輸入：VGA、HDMI。'
        ]);
        $Classroom -> save();

        $Classroom = new Classroom([
            'classroomName' => 'I1_107',
            'imagePath' => '/img/classroom/I1_107.jpg',
            'equipmentDescription' => 
                '座位數：80。
                基本設備：筆記型電腦(含網路)、投影機、麥克風、冷氣。
                網路：無線網路。
                聲音輸入：講桌3.5音源輸入。
                顯示訊號輸入：VGA、HDMI。'
        ]);
        $Classroom -> save();

        $Classroom = new Classroom([
            'classroomName' => 'I1_223',
            'imagePath' => '/img/classroom/I1_223.jpg',
            'equipmentDescription' => 
                '座位數：15。
                基本設備：筆記型電腦(含網路)、無線網路、投影機、高畫質內投影顯示器、冷氣。
                網路：無線網路。
                聲音輸入：無。
                顯示訊號輸入：VGA、HDMI。
                
                ※備註：本教室無麥克風，平日11:00-14:00優先供系辦會議使用。'
        ]);
        $Classroom -> save();

        $Classroom = new Classroom([
            'classroomName' => 'I1_404',
            'imagePath' => '/img/classroom/I1_404.jpg',
            'equipmentDescription' => 
                '座位數：64。
                基本設備：筆記型電腦(含網路)、無線網路、投影機、麥克風、冷氣。
                網路：網路孔、無線網路。
                聲音輸入：講桌3.5音源輸入。
                顯示訊號輸入：VGA、HDMI。
                
                ※備註：假日及週間17:00以後不外借。'
        ]);
        $Classroom -> save();

        $Classroom = new Classroom([
            'classroomName' => 'I1_507_1',
            'imagePath' => '/img/classroom/I1_507_1.jpg',
            'equipmentDescription' => 
                '座位數：15。
                基本設備：投影機、冷氣。
                網路：無線網路。
                聲音輸入：無。
                顯示訊號輸入：VGA。'
        ]);
        $Classroom -> save();

        $Classroom = new Classroom([
            'classroomName' => 'I1_933',
            'imagePath' => '/img/classroom/I1_933.jpg',
            'equipmentDescription' => 
                '※預約請至933門口月曆登記及查詢預約情形。
                座位數：15。
                基本設備：投影機、冷氣。
                網路：無線網路。
                聲音輸入：無。
                顯示訊號輸入：VGA。
                
                ※備註：本教室無麥克風。'
        ]);
        $Classroom -> save();
    }
}
