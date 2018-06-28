<?php
/*
Plugin Name: Import Voitures (Test Soukaina)
Description: Import des modèles de voitures
Version: 1
Author: Soukaina MJAHED
*/

// function to create the DB / Options / Defaults                   
function smj_import_voitures_install() {
    // Nothing to do
}
// run the install scripts upon plugin activation
register_activation_hook(__FILE__, 'smj_import_voitures_install');

//menu items
add_action('admin_menu','smj_import_voitures_modifymenu');
function smj_import_voitures_modifymenu() {
   
    //this is the main item for the menu
    add_menu_page('Import Voitures', //page title
    'Import Voitures', //menu title
    'manage_options', //capabilities
    'smj_import_voitures_form', //menu slug
    'smj_import_voitures_form' //function
    );
}

function smj_import_voitures_form() {

    if (isset($_POST['import']) && isset($_POST['main_category']) && isset($_FILES['file_to_import'])) {
        // Init
        $main_category = $_POST["main_category"];
        $csv_file = $_FILES['file_to_import']['tmp_name'];

        // Create main category
        $main_category_id = term_exists($main_category);
        if(!$main_category_id) {
            // Create category
            $main_category_id = wp_create_category($main_category);
        }

        // Read CSV file
        $created_marque = 0;
        $first = true;
        if (($handle = fopen($csv_file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
                if($first) {
                    $first = false;
                    continue;
                }
                $num = count($data);
                $marque = $data[0];
                $modele = $data[1];
                $marque_category_id = term_exists($marque, '', $main_category_id);
                if(!$marque_category_id) {
                    $marque_category_id = wp_create_category($marque, $main_category_id);
                }
                $modele_category_id = term_exists($modele, '', $marque_category_id);
                if(!$modele_category_id) {
                    $modele_category_id = wp_create_category($modele, $marque_category_id);
                }
                if($modele_category_id) {
                    $created_marque++;
                }
            }
            fclose($handle);

            $message = "Marques créées avec succès ($created_marque)";
        }
    }

    ?>
    <div class="wrap">
        <h2>Nouveau import</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">
            <input type="text" name="main_category" placeholder="Catégorie mère">
            <input type='file' id='file_to_import' name='file_to_import'>
            <input type='submit' name="import" value='Importer' class='button'>
        </form>
    </div>
   
    <?php
}
?>