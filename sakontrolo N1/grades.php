<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>პრაქტიკული 1</title>
</head>
<body>

    <?php
        $group = 
        [
            ['name' => "ნინო", 'aqtivoba' => 27, 'shualeduri' => 25, 'finaluri' => 36],
            ['name' => "გიორგი", 'aqtivoba' => 15, 'shualeduri' => 12, 'finaluri' => 18],
            ['name' => "ანა", 'aqtivoba' => 30, 'shualeduri' => 28, 'finaluri' => 39],
            ['name' => "ლუკა", 'aqtivoba' => 20, 'shualeduri' => 18, 'finaluri' => 30],
            ['name' => "მარიამ", 'aqtivoba' => 22, 'shualeduri' => 14, 'finaluri' => 10],
        ];

        function jami($a, $b, $c)
        {
            return $a + $b + $c;
        }

        function shefaseba($jami)
        {
            if($jami >= 91)
                {
                return "A";
            }
            elseif($jami >= 81)
            {
                return "B";
            }
            elseif($jami >= 71)
                {
                return "C";
            }
            elseif($jami >= 61)
                {
                return "D";
            }
            elseif($jami >= 51)
                {
                return "E";
            }
            elseif($jami >= 41)
                {
                return "FX";
            }
            else
                {
                return "F";
            }
        }
    ?>

    <form method="get">
        მინიმალური ჯამი (min): <input type="text" name="min">
        <br><br>
        <button>ფილტრი</button>
    </form>

    <hr>

    <table border="1">
        <tr>
            <th>№</th>
            <th>სახელი</th>
            <th>აქტივობა</th>
            <th>შუალედური</th>
            <th>ფინალური</th>
            <th>ჯამი</th>
            <th>შეფასება</th>
        </tr>

        <?php
            $filtered_group = [];
            
            if(isset($_GET['min']) && $_GET['min'] !== "")
                {
                $min_val = $_GET['min'];
                for($i = 0; $i < count($group); $i++)
                    {
                    $t = jami($group[$i]['aqtivoba'], $group[$i]['shualeduri'], $group[$i]['finaluri']);
                    if($t >= $min_val)
                        {
                        $filtered_group[] = $group[$i];
                    }
                }
            } 
            else 
                {
                $filtered_group = $group;
            }

            $count = count($filtered_group);
            $total_sum = 0;

            for($i = 0; $i < $count; $i++)
                {
                $st = $filtered_group[$i];
                $s_jami = jami($st['aqtivoba'], $st['shualeduri'], $st['finaluri']);
                $s_grade = shefaseba($s_jami);
                $total_sum += $s_jami;

                $num = $i + 1;
                echo "<tr>";
                echo "<td>$num</td>";
                echo "<td>".$st['name']."</td>";
                echo "<td>".$st['aqtivoba']."</td>";
                echo "<td>".$st['shualeduri']."</td>";
                echo "<td>".$st['finaluri']."</td>";
                echo "<td>$s_jami</td>";
                echo "<td>$s_grade</td>";
                echo "</tr>";
            }
        ?>
    </table>

    <?php
        echo "<hr>";
        if($count > 0)
            {
            $avg = $total_sum / $count;
            echo "სტუდენტების რაოდენობა: $count <br>";
            echo "საშუალო ქულა: $avg";
        } else {
            echo "სტუდენტები არ მოიძებნა.";
        }
    ?>

    <hr><hr>

    <form action="" method="post">
        სახელი: <input type="text" name="saxeli">
        <br><br>
        აქტივობა (0-30): <input type="text" name="aqtivoba">
        <br><br>
        შუალედური (0-30): <input type="text" name="shualeduri">
        <br><br>
        ფინალური (0-40): <input type="text" name="finaluri">
        <br><br>
        <button>გაგზავნა</button>
    </form>

    <hr>

    <?php
        if(isset($_POST['saxeli']))
            {
            $name = $_POST['saxeli'];
            $aqt = $_POST['aqtivoba'];
            $shual = $_POST['shualeduri'];
            $fin = $_POST['finaluri'];

            if($aqt < 0 || $aqt > 30){
                echo "შეცდომა: აქტივობა უნდა იყოს 0-დან 30-მდე.";
            }elseif($shual < 0 || $shual > 30)
            {
                echo "შეცდომა: შუალედური უნდა იყოს 0-დან 30-მდე.";
            }elseif($fin < 0 || $fin > 40){
                echo "შეცდომა: ფინალური უნდა იყოს 0-დან 40-მდე.";
            }else{
                $t_jami = jami($aqt, $shual, $fin);
                $t_grade = shefaseba($t_jami);

                $student = [
                    'name' => $name,
                    'total' => $t_jami,
                    'grade' => $t_grade
                ];

                echo "სახელი: ".$student['name']."<br>";
                echo "ჯამი: ".$student['total']."<br>";
                echo "შეფასება: ".$student['grade']."<br>";
            }
        }
    ?>

</body>
</html>