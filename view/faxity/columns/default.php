w<?php

namespace Anax\View;

/**
 * Render a multiple amount of columns and render a complete view as the
 * content of each column.
 */

$defaultTemplate = "anax/v2/block/default";
?>

<div class="columns">
    <?php foreach ($columns as $column) :
        $template = $column["template"] ?? $defaultTemplate;
        $data = $column["data"] ?? $column;
        ?>

    <div class="column">
        <?php renderView($template, $data) ?>
    </div>

    <?php endforeach; ?>
</div>
