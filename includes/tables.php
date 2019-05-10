<?php 
function get_geolocation_tables($is_country_name, $is_country_code, $country_flag_url, $public_ip) {
ob_start();
?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Public page</title>
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
    <div class="container">
    <div class="row">
    <div class="col 12">
    <h1>GEO Location API</h1>
    <ul>
        <li>Public IP: <?php echo '<b>'. $public_ip . '</b>'; ?></li>
        <li>Location: <?php echo $is_country_name . ', ' .$is_country_code; ?> </li>
    </ul>
    <div class="divider"></div>
    </div>
    
    <div class="col 12">
    <?php if ($is_country_name === 'Bulgaria' && $is_country_code === 'BG'){ ?>
        <table class="striped highlight responsive-table centered">
            <thead>
                <tr>
                    <th>Operator</th>
                    <th>Table 1 Description</th>
                    <th>Bonus</th>
                    <th>Country</th>
                    <th>Code</th>
                    <th>Review</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img src="<?php echo $country_flag_url; ?>" alt="BG Flag" width="75" height="45"/></td>
                    <td>Dolores est temporibus omnis sint laborum sint. Vero facere blanditiis rem aspernatur aut harum. Minus ut dolor ducimus non consectetur corrupti nihil quibusdam.</td>
                    <td>$555</td>
                    <td><?php echo $is_country_name; ?></td>
                    <td><?php echo $is_country_code; ?></td>
                    <td><a href="#!" class="waves-effect waves-light btn">Review</a></td>
                    <td><a href="#!" class="waves-effect waves-light btn">START</a></td>
                </tr>
                <tr>
                    <td><img src="<?php echo $country_flag_url; ?>" alt="BG Flag" width="75" height="45"/></td>
                    <td>Dolores est temporibus omnis sint laborum sint. Vero facere blanditiis rem aspernatur aut harum. Minus ut dolor ducimus non consectetur corrupti nihil quibusdam.</td>
                    <td>$555</td>
                    <td><?php echo $is_country_name; ?></td>
                    <td><?php echo $is_country_code; ?></td>
                    <td><a href="#!" class="waves-effect waves-light btn">Review</a></td>
                    <td><a href="#!" class="waves-effect waves-light btn">START</a></td>
                </tr>
                <tr>
                    <td><img src="<?php echo $country_flag_url; ?>" alt="BG Flag" width="75" height="45"/></td>
                    <td>Dolores est temporibus omnis sint laborum sint. Vero facere blanditiis rem aspernatur aut harum. Minus ut dolor ducimus non consectetur corrupti nihil quibusdam.</td>
                    <td>$555</td>
                    <td><?php echo $is_country_name; ?></td>
                    <td><?php echo $is_country_code; ?></td>
                    <td><a href="#!" class="waves-effect waves-light btn">Review</a></td>
                    <td><a href="#!" class="waves-effect waves-light btn">START</a></td>
                </tr>
                <tr>
                    <td><img src="<?php echo $country_flag_url; ?>" alt="BG Flag" width="75" height="45"/></td>
                    <td>Dolores est temporibus omnis sint laborum sint. Vero facere blanditiis rem aspernatur aut harum. Minus ut dolor ducimus non consectetur corrupti nihil quibusdam.</td>
                    <td>$555</td>
                    <td><?php echo $is_country_name; ?></td>
                    <td><?php echo $is_country_code; ?></td>
                    <td><a href="#!" class="waves-effect waves-light btn">Review</a></td>
                    <td><a href="#!" class="waves-effect waves-light btn">START</a></td>
                </tr>
                <tr>
                    <td><img src="<?php echo $country_flag_url; ?>" alt="BG Flag" width="75" height="45"/></td>
                    <td>Dolores est temporibus omnis sint laborum sint. Vero facere blanditiis rem aspernatur aut harum. Minus ut dolor ducimus non consectetur corrupti nihil quibusdam.</td>
                    <td>$555</td>
                    <td><?php echo $is_country_name; ?></td>
                    <td><?php echo $is_country_code; ?></td>
                    <td><a href="#!" class="waves-effect waves-light btn">Review</a></td>
                    <td><a href="#!" class="waves-effect waves-light btn">START</a></td>
                </tr>
            </tbody>
        </table>
        <br/>
        <div class="divider"></div>
        <br/>
        <table class="striped highlight responsive-table centered">
            <thead>
                <tr>
                    <th>Operator</th>
                    <th>Table 2 Description</th>
                    <th>Bonus</th>
                    <th>Country</th>
                    <th>Code</th>
                    <th>Review</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img src="<?php echo $country_flag_url; ?>" alt="BG Flag" width="75" height="45"/></td>
                    <td>Dolores est temporibus omnis sint laborum sint. Vero facere blanditiis rem aspernatur aut harum. Minus ut dolor ducimus non consectetur corrupti nihil quibusdam.</td>
                    <td>$555</td>
                    <td><?php echo $is_country_name; ?></td>
                    <td><?php echo $is_country_code; ?></td>
                    <td><a href="#!" class="waves-effect waves-light btn">Review</a></td>
                    <td><a href="#!" class="waves-effect waves-light btn">START</a></td>
                </tr>
            </tbody>
        </table>
    
    <?php } else if ($is_country_name === 'Denmark' && $is_country_code === 'DK'){ ?>
        <table id="int" class="striped highlight responsive-table centered">
            <thead>
                <tr>
                    <th>Operator</th>
                    <th>Description</th>
                    <th>Bonus</th>
                    <th>Country</th>
                    <th>Code</th>
                    <th>Review</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img src="<?php echo $country_flag_url; ?>" alt="Denmark Flag" width="75" height="45"/></td>
                    <td>Dolores est temporibus omnis sint laborum sint. Vero facere blanditiis rem aspernatur aut harum. Minus ut dolor ducimus non consectetur corrupti nihil quibusdam.</td>
                    <td>$555</td>
                    <td><?php echo $is_country_name; ?></td>
                    <td><?php echo $is_country_code; ?></td>
                    <td><a href="#!" class="waves-effect waves-light btn">Review</a></td>
                    <td><a href="#!" class="waves-effect waves-light btn">START</a></td>
                </tr>
                <tr>
                    <td><img src="<?php echo $country_flag_url; ?>" alt="Denmark Flag" width="75" height="45"/></td>
                    <td>Dolores est temporibus omnis sint laborum sint. Vero facere blanditiis rem aspernatur aut harum. Minus ut dolor ducimus non consectetur corrupti nihil quibusdam.</td>
                    <td>$1000</td>
                    <td><?php echo $is_country_name; ?></td>
                    <td><?php echo $is_country_code; ?></td>
                    <td><a href="#!" class="waves-effect waves-light btn">Review</a></td>
                    <td><a href="#!" class="waves-effect waves-light btn">START</a></td>
                </tr>
            </tbody>
        </table>
    <?php } else { ?>
        <table id="int" class="striped highlight responsive-table centered">
            <thead>
                <tr>
                    <th>Operator</th>
                    <th>Description</th>
                    <th>Bonus</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img src="<?php echo $country_flag_url; ?>" alt="INT Flag" width="75" height="45"/></td>
                    <td>Dolores est temporibus omnis sint laborum sint. Vero facere blanditiis rem aspernatur aut harum. Minus ut dolor ducimus non consectetur corrupti nihil quibusdam.</td>
                    <td>$555</td>
                    <td><?php echo $is_country_name; ?></td>
                    <td><?php echo $is_country_code; ?></td>
                    <td><a href="#!" class="waves-effect waves-light btn">Review</a></td>
                    <td><a href="#!" class="waves-effect waves-light btn">START</a></td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>
    </div>
    <?php } ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    </body>
    </html>
<?php

$content = ob_get_clean();
echo $content;

}?>