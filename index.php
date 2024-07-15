<?php
    $url = 'https://news.google.com/rss?hl=zh-TW&gl=TW&ceid=TW:zh-Hant';
    $xmlContent = file_get_contents($url);
    $xmlElement = new SimpleXMLElement($xmlContent);
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google News</title>
    <style>
        .news-table {border-collapse: collapse;}
        .news-table a {color: #202020; text-decoration: none;}
        .news-table a:hover {text-decoration: underline;}
        .news-table td {padding: 8px; border: 1px solid;}
        .hidden {display: none;}
    </style>
    <script>
        function toggleTd(button) {
            var tr = button.parentElement.parentElement.nextElementSibling;
            if (tr.classList.contains('hidden')) {
                tr.classList.remove('hidden');
                button.textContent = '收起';
            } else {
                tr.classList.add('hidden');
                button.textContent = '更多';
            }
        }
    </script>
</head>
<body>
    <table class="news-table">
        <tbody>
            <?php foreach ($xmlElement->channel->item as $item): ?>
                <tr>
                    <td><a href="<?= $item->link ?>" target="_blank"><?= $item->title ?></a></td>
                    <td><button onclick="toggleTd(this)">更多</button></td>
                </tr>
                <tr class="hidden">
                    <td><?= $item->description ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
