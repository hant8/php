<div class="often-question">
    <div class="grid-container">
        <div class="often-question heading">Часто задаваемые вопросы</div>
        <div class="often-question-wrapper">
        <?php

        $question = $database['question'];

        foreach($question as $key => $value){

            $questionTitle = $value['title'];
            $questionDescription = $value['description'];
            include('templates/blocks/often-question-item.php');

        }

        ?>
        </div>
    </div>
</div>