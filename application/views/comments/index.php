

<p>Введите Ваш комментарий</p>
<form method="post">
    <p><input name="name" placeholder="ФИО/никнейм"></p>
    <p><input name="email" placeholder="емайл" required="required"></p>
    <p><input name="comment" placeholder="текст комментария" required="required"></p>
    <p><input type="submit" value="Отправить"></p>
</form>

<?php /** @var array $comments */
foreach ($comments as $comment => $value) :?>
<br>
<hr>
<?php echo $value['user_name']?>
<br>
<?php echo  $value['comment'];?>
<?php endforeach; ?>
