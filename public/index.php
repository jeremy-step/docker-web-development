<?php

require_once __DIR__ . '/../vendor/autoload.php';

$clientRedis = new Predis\Client("tcp://{$_ENV['REDIS_HOST']}:{$_ENV['REDIS_PORT']}");

$valueRedis = DateTime::createFromFormat('Y-m-d H:i:s', $clientRedis->get('previous_refresh') ?? '') ?: null;

$clientRedis->set('previous_refresh', new DateTime()->format('Y-m-d H:i:s'));

$clientMysql = new PDO("mysql:dbname={$_ENV['MYSQL_DATABASE']};host={$_ENV['MYSQL_HOST']}", $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD']);
$clientMysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $clientMysql->prepare(<<<'SQL'
    CREATE TABLE IF NOT EXISTS `example` (
        `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `inserted` DATETIME NOT NULL
    )
SQL);

$stmt->execute();

$stmt = $clientMysql->prepare(<<<'SQL'
    INSERT INTO `example` (`inserted`) VALUES (?)
SQL);

$stmt->execute([new DateTime()->format('Y-m-d H:i:s')]);

$resultMysql = $clientMysql->prepare(<<<'SQL'
    SELECT `id`, `inserted` FROM `example` ORDER BY `inserted` DESC, `id` DESC LIMIT 10
SQL);

$resultMysql->execute();

mail('test@example.com', 'Mailpit Test Email', 'This message was sent by the PHP mail() function...');

?>

<h1>PHP Example</h1>

<h2>PHP Info</h2>

<label id="php-info-toggle">
    Toggle
    <input type="checkbox">
</label>

<div style="display: none; width: min-content">
    <?php phpinfo(); ?>
</div>

<h2>Mailpit</h2>

<code><span class="phps-f">mail</span>(<span class="phps-s">'test@example.com'</span>, <span class="phps-s">'Mailpit Test Email'</span>, <span class="phps-s">'This message was sent by the PHP mail() function...'</span>);</code>

<p>
    Checkout the Mailpit mailbox by going to <a href="http://localhost:<?= $_ENV['MAILPIT_UI_PORT'] ?>" target="_blank">http://localhost:<?= $_ENV['MAILPIT_UI_PORT'] ?></a>
</p>

<h2>Redis example</h2>

<h3>Code:</h3>

<code style="white-space: pre-wrap;"><span class="phps-v">$clientRedis</span> = <span class="phps-k">new</span> Predis\<span class="phps-f">Client</span>(<span class="phps-s">"tcp://<span class="phps-v">{$_ENV[</span><span class="phps-a">'REDIS_HOST'</span><span class="phps-v">]}</span>:<span class="phps-v">{$_ENV[</span><span class="phps-a">'REDIS_PORT'</span><span class="phps-v">]}</span>"</span>);

<span class="phps-v">$valueRedis</span> = <span class="phps-f">DateTime</span>::<span class="phps-f">createFromFormat</span>(<span class="phps-s">'Y-m-d H:i:s'</span>, <span class="phps-v">$clientRedis</span>-><span class="phps-f">get</span>(<span class="phps-s">'previous_refresh'</span>) <span class="phps-k">??</span> <span class="phps-s">''</span>) <span class="phps-k">?:</span> <span class="phps-k">null</span>;

<span class="phps-v">$clientRedis</span>-><span class="phps-f">set</span>(<span class="phps-s">'previous_refresh'</span>, <span class="phps-k">new</span> <span class="phps-f">DateTime</span>()-><span class="phps-f">format</span>(<span class="phps-s">'Y-m-d H:i:s'</span>));</code>

<h3>Result:</h3>

<p>
    previous_refresh = <?= $valueRedis?->format('H:i:s d/m/Y') ?? 'null' ?>
</p>

<h2>MySQL example</h2>

<p>
    Checkout the Adminer database manager by going to <a href="http://localhost:<?= $_ENV['ADMINER_PORT'] ?>" target="_blank">http://localhost:<?= $_ENV['ADMINER_PORT'] ?></a>
</p>

<h3>Code:</h3>

<code style="white-space: pre-wrap;"><span class="phps-v">$clientMysql</span> = <span class="phps-k">new</span> <span class="phps-f">PDO</span>(<span class="phps-s">"mysql:dbname=<span class="phps-v">{$_ENV[</span><span class="phps-a">'MYSQL_DATABASE'</span><span class="phps-v">]}</span>;host=<span class="phps-v">{$_ENV[</span><span class="phps-a">'MYSQL_HOST'</span><span class="phps-v">]}</span>"</span>, <span class="phps-v">$_ENV[</span><span class="phps-a">'MYSQL_USER'</span><span class="phps-v">]</span>, <span class="phps-v">$_ENV[</span><span class="phps-a">'MYSQL_PASSWORD'</span><span class="phps-v">]</span>);
<span class="phps-v">$clientMysql</span>-><span class="phps-f">setAttribute</span>(<span class="phps-f">PDO</span>::ATTR_ERRMODE, <span class="phps-f">PDO</span>::ERRMODE_EXCEPTION);

<span class="phps-v">$stmt</span> = <span class="phps-v">$clientMysql</span>-><span class="phps-f">prepare</span>(<span class="phps-s">&lt;&lt;&lt;'SQL'
    <span class="sql-k">CREATE TABLE</span> <span class="sql-f">IF NOT EXISTS</span> `<span class="sql-f">example</span>` (
        `<span class="sql-f">id</span>` <span class="sql-k">INT</span>(11) <span class="sql-k">UNSIGNED AUTO_INCREMENT PRIMARY KEY</span>,
        `<span class="sql-f">inserted</span>` <span class="sql-k">DATETIME NOT NULL</span>
    )
SQL</span>);

<span class="phps-v">$stmt</span>-><span class="phps-f">execute</span>();

<span class="phps-v">$stmt</span> = <span class="phps-v">$clientMysql</span>-><span class="phps-f">prepare</span>(<span class="phps-s">&lt;&lt;&lt;'SQL'
    <span class="sql-k">INSERT INTO</span> `<span class="sql-f">example</span>` (`<span class="sql-f">inserted</span>`) <span class="sql-k">VALUES</span> (?)
SQL</span>);

<span class="phps-v">$stmt</span>-><span class="phps-f">execute</span>([<span class="phps-k">new</span> <span class="phps-f">DateTime</span>()-><span class="phps-f">format</span>(<span class="phps-s">'Y-m-d H:i:s'</span>)]);

<span class="phps-v">$resultMysql</span> = <span class="phps-v">$clientMysql</span>-><span class="phps-f">prepare</span>(<span class="phps-s">&lt;&lt;&lt;'SQL'
    <span class="sql-k">SELECT</span> `<span class="sql-f">id</span>`, `<span class="sql-f">inserted</span>` <span class="sql-k">FROM</span> `<span class="sql-f">example</span>` <span class="sql-k">ORDER BY</span> `<span class="sql-f">inserted</span>` <span class="sql-k">DESC LIMIT</span> 10
SQL</span>);

<span class="phps-v">$resultMysql</span>-><span class="phps-f">execute</span>();

&lt;table&gt;
    &lt;tr&gt;
        &lt;th&gt;ID&lt;/th&gt;
        &lt;th&gt;Date&lt;/th&gt;
    &lt;/tr&gt;

    <span class="phps-t">&lt;?php</span> <span class="phps-k">while</span>(<span class="phps-v">$row</span> = <span class="phps-v">$resultMysql</span>-><span class="phps-f">fetch</span>(<span class="phps-f">PDO</span>::FETCH_OBJ)) : <span class="phps-t">?&gt;</span>
        &lt;tr&gt;
            &lt;td&gt;<span class="phps-t">&lt;?=</span> <span class="phps-v">$row</span>->id <span class="phps-t">?&gt;</span>&lt;/td&gt;
            &lt;td&gt;<span class="phps-t">&lt;?=</span> <span class="phps-f">DateTime</span>::<span class="phps-f">createFromFormat</span>(<span class="phps-s">'Y-m-d H:i:s'</span>, <span class="phps-v">$row</span>->inserted)-><span class="phps-f">format</span>(<span class="phps-s">'H:i:s d/m/Y'</span>) <span class="phps-t">?&gt;</span>&lt;/td&gt;
        &lt;/tr&gt;
    <span class="phps-t">&lt;?php</span> <span class="phps-k">endwhile</span>; <span class="phps-t">?&gt;</span>
&lt;/table&gt;</code>

<h3>Result:</h3>

<table>
    <tr><th>ID</th><th>Date</th></tr>

    <?php while($row = $resultMysql->fetch(PDO::FETCH_OBJ)) : ?>
        <tr><td><?= $row->id ?></td><td><?= DateTime::createFromFormat('Y-m-d H:i:s', $row->inserted)->format('H:i:s d/m/Y') ?></td></tr>
    <?php endwhile; ?>
</table>

<style>
    :root {
        --phps-keyword: #af00db;
        --phps-variable: #001080;
        --phps-function: #795e26;
        --phps-string: #a31515;
        --phps-tag: #0000ff;
        --phps-array-key: #098658;
        --sql-keyword: #0000ff;
        --sql-function: #267f99;
    }

    @media (prefers-color-scheme: dark) {
        :root {
            --phps-keyword: #c586c0;
            --phps-variable: #9cdcfe;
            --phps-function: #dcdcaa;
            --phps-string: #ce9178;
            --phps-tag: #569cd6;
            --phps-array-key: #b5cea8;
            --sql-keyword: #569cd6;
            --sql-function: #4ec9b0;
        }
    }

    code .phps-k { color: var(--phps-keyword); }
    code .phps-v { color: var(--phps-variable); }
    code .phps-f { color: var(--phps-function); }
    code .phps-s { color: var(--phps-string); }
    code .phps-t { color: var(--phps-tag); }
    code .phps-a { color: var(--phps-array-key); }
    code .sql-k { color: var(--sql-keyword); }
    code .sql-f { color: var(--sql-function); }

    h1 {
        font-size: 2rem;
    }

    h2 {
        font-size: 1.5rem;
    }

    h3 {
        font-size: 1rem;
    }

    #php-info-toggle:has(input:checked) + div {
        display: block !important;
    }
</style>