<?php
$part = $_GET['part'];
session_start();
$_SESSION['data'] = $part;
require './common/header.html';

switch ($part)
{


case "u1":
    require "./part/9-u1.php"; // 单词数据文件
    break;
/** /这个勿删！ **/
    
case "home":
    
    require "./part/home.html";
    return;
    break;
    
default:
    $error= true;
   echo '<div class="flex flex-col items-center justify-center min-h-[600px]"><h2 class="text-2xl font-medium text-gray-900 mb-4">课程出错了</h2>
<p class="text-gray-600 mb-8">当前单元课程不存在</p>
<div class="flex space-x-4">
<a href= "?part=home" class="px-6 py-2 bg-primary text-white hover:bg-primary/90 !rounded-button whitespace-nowrap">
返回到首页
</a>
</div></div>';
return;
}


$data = json_decode($jsonString, true);


if (json_last_error() === JSON_ERROR_NONE) {

    $order = isset($_GET['order']) ? $_GET['order'] : 'normal';

    switch ($order) {
        case 'reverse':
            $data['questions'] = array_reverse($data['questions']);
            break;
        default:
            break;
    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


        $userAnswers = $_POST['answers'];
        $correctAnswers = 0;
        $results = [];

        foreach ($data['questions'] as $index => $question) {
            $userAnswer = strtolower(trim($userAnswers[$index]));
            $correctAnswer = strtolower($question['english']);
            if ($userAnswer == $correctAnswer) {
                $correctAnswers++;
                $results[] = ["chinese" => $question['chinese'], "english" => $correctAnswer, "result" => "<i class='fa-solid fa-check'></i>"];
            } else {
                $results[] = ["chinese" => $question['chinese'], "english" => $correctAnswer, "result" => "<i class='fa-solid fa-xmark'></i>", "userAnswer" => $userAnswer];
            }
        }
echo ' <div style=" margin-bottom: -33px;   font-family: `Harmony` !important;
                                               
        transition: all 0.3s ease;
        animation: fadeIn 1s linear;" class="flex items-start gap-8 p-4 bg-gray-50 rounded-lg">
                    <div class="w-1/3">
                        <div style="margin-bottom:4px;font-size:23px;" class="text-lg font-medium text-gray-900">检查结果
                        
                          <a onclick='."speakText('"."答对了" . $correctAnswers . '个，共' . count($data['questions']) . "个')".' class="mt-2 text-primary hover:text-primary/80 text-sm flex items-center gap-1">
                            <i class="fas fa-play"></i>
                            结果
                        </a></div>
                        ';
        echo "<p>答对了 " . $correctAnswers . " 个，共" . count($data['questions']) . "个.</p><div class='flex justify-between items-center mb-6'>
                </div>";
        echo "<div style='margin-bottom:4px;font-size:23px;' class='text-lg font-medium text-gray-900'>答案解析</div><table style='                  
      transition: all 0.3s ease;
        animation: fadeIn 1s linear;
        background-color: rgb(255 255 255);
        color: #000000;
        border: 5px dashed #cdcdcd;
        border-radius: 10px;
        width: 299%;
        font-size: 20px;'>";
        echo "<tr><th>中文</th><th>英文</th><th>你的答案</th><th>√/×</th></tr>";
        foreach ($results as $result) {
            echo "<tr style='    border: 1px solid;'>";
            echo "<td>" . $result['chinese'] . "</td>";
            echo "<td>" . $result['english'] . " <a style='color:#000000' onclick= "."speakText('".$result['english']."')".' class="mt-2 text-primary hover:text-primary/80 text-sm flex items-center gap-1">
                           '.'<i class="fas fa-play"></i>
                            播放英语
                        </a></td>';
            echo "<td>" . ("<i class='fa-solid fa-circle-xmark'></i>".isset($result['userAnswer']) ? $result['userAnswer'] : '') . "</td>";
            echo "<td>" . $result['result'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo '  <br>   <button onclick="ro()" class="bg-primary text-white px-6 py-2 rounded-button hover:bg-primary/90">
                重写
            </button> </div>
                    
                </div>
                <br>';
                return;
    }
}elseif ($error == true) {
    echo '<style>.checks{display:none;}</style>';
} else {
      echo '<div class="flex flex-col items-center justify-center min-h-[600px]"><h2 class="text-2xl font-medium text-gray-900 mb-4">出错了</h2>
<p class="text-gray-600 mb-8">当前课程配置文件出错,请检查单元配置是否正确。</p>
<div class="flex space-x-4">
<a href= "?part=home" class="px-6 py-2 bg-primary text-white hover:bg-primary/90 !rounded-button whitespace-nowrap">
返回到首页
</a>
</div></div>';

return;

}
?>
<script src="https://cdn.jsdelivr.net/npm/speakjs@0.2.0/speak.min.js"></script>
<script>
    
</script>

  
   <form type="hidden" method="post">
         <div class="flex justify-between items-center mb-6">
                <div class="text-sm text-gray-500">总共单词数量</div>
                <div class="flex-1 mx-8 h-2 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-primary" style="width: <?php echo count($data['questions'])?>%"></div>
                </div>
                <div class="text-sm text-gray-500"><?php echo count($data['questions'])?></div>
            </div>
        <?php foreach ($data['questions'] as $index => $question): ?>
            <div>

            <div style="                  
        transition: all 0.3s ease;
        animation: fadeIn 1s linear;" class="flex items-start gap-8 p-4 bg-gray-50 rounded-lg">
                    <div class="w-1/3">
                        <div class="text-lg font-medium text-gray-900"><?php echo $question['chinese']; ?></div>
                        
                    <a onclick="speakText('<?php echo addslashes($question['chinese']); ?>')" class="mt-2 text-primary hover:text-primary/80 text-sm flex items-center gap-1">
                            <i class="fas fa-play"></i>
                            播放读音
                        </a>
                    </div>
                    
                    <div class="flex-1">
                        <input onclick="speakText('<?php echo addslashes($question['chinese']); ?>')" name="answers[<?php echo $index; ?>]" type="text" class="underline-input w-full text-lg px-2 py-1" placeholder="请输入英文...">
                      
                    </div>
                </div>
                <br>



              
            </div>
        <?php endforeach; ?>
          <div class="flex justify-center gap-4">
        <button type="sumbit" class="checks bg-primary text-white px-6 py-2 rounded-button hover:bg-primary/90">
                提交答案
            </button></div>
    </form>
    
</body>
</html>
