<?php include 'core/sessions.php'; ?>
<?php if($_GET['item'] == 'exams') : ?>
<table class="table_blur">
    <tr>
        <th>Предмет</th>
        <th>Аудитория</th>
        <th>Время</th>
        <th>Дата</th>
    </tr>
    <tr>
        <td>Веб технологии</td>
        <td>609ф</td>
        <td>9:00</td>
        <td>11 июня</td>
    </tr>
    <tr>
        <td>Философия</td>
        <td>204ф</td>
        <td>9:00</td>
        <td>14 июня</td>
    </tr>
    <tr>
        <td>ООП</td>
        <td>607ф</td>
        <td>9:00</td>
        <td>19 июня</td>
    </tr>
    <tr>
        <td>Английский язык</td>
        <td>не разборчиво написано :(</td>
        <td>9:00</td>
        <td>22 июня</td>
    </tr>
    <tr>
        <td>Теория вероятности</td>
        <td>606ф</td>
        <td>9:00</td>
        <td>26 июня</td>
    </tr>
</table>

<?php endif; ?>
