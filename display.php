<?php session_start(); ?>
    <ul>
        <?php if (isset($_SESSION['success'])) {
            foreach ($_SESSION['success'] as $key => $value) { ?>
                <li><strong><?= "$key :"; ?></strong><?= " $value <br>"; ?></li>
        <?php
            }
        }
        ?>
    </ul>
