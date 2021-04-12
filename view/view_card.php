<?php
    $menu_title = 'Card "'.$card->get_title().'"';
    $menu_subtitle = "Boards";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $menu_title?></title>
        <base href="<?= $web_root ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/menu.css" rel="stylesheet" type="text/css"/>
        <link href="css/card_view.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php include("menu.php");?>
        <div class="content">
            <div class="card-header">
                <h2>
                    <?= $menu_title?> 
                    <a href=<?= "card/edit/".$card->get_card_id() ?> class="invisible-link"><i class="fa fa-edit"></i></a>
                    <a href=<?= "card/delete_confirm/".$card->get_card_id() ?> class="invisible-link"><i class="fa fa-trash"></i></a>
                </h2>
                <h4>Created by <span><?= $card->get_author_name() ?></span> <?= $card->get_duration_since_creation() ?> ago. <?= $card->get_last_modification()?"Modified ".$card->get_duration_since_last_edit()." ago.":"Never modified." ?></h4>
                <h4>This card is on the board "<span><a href=<?= "board/board/".$card->get_board_id() ?> ><?= $card->get_board_title() ?></a></span>", column "<span><?= $card->get_column_title() ?></span>" at position <?= $card->get_position() ?>.</h4>
            </div>
            <div class="card-body">
                <h3>Body</h3>
                <form>
                    <textarea readonly class="form-control"><?= $card->get_body()?></textarea>
                </form>
                <br>
                <?php if (count($card->get_participants()) != 0): ?>
                        <h3>Current participant(s)</h3>
                        <ul>
                            <?php foreach ($card->get_participants() as $participant): ?>
                                <li>
                                    <span class="participant"><?= $participant->get_full_name().' ('.$participant->get_mail().') ' ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <h3>This card has no participant yet.</h3>
                    <?php endif; ?>
            </div>
        </div>
    </body>
</html>