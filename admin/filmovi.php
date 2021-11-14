<?php include "includes/admin_header.php"; ?>
<?php include_once "functions.php"; ?>
<?php include "includes/admin_navigation.php"; ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                   <h1 class="page-header">
                        FILMOVI
                        <small>Ispit</small>
                    </h1>
                        <?php 
                        $source = isset($_GET['source']) ? $_GET['source'] : "";
                        switch($source):
                            case 'dodaj_film':
                                include "includes/dodaj_film.php";
                            break;
                            case 'izmeni_film':
                                include "includes/izmeni_film.php";
                            break;    
                            default:
                                include "includes/svi_filmovi.php";
                            break;
                        endswitch;
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<script>
    var url = window.location.href;     // Proverava da li u url ima ? parametar
    if(url.includes('?')){
        ClassicEditor
            .create( document.querySelector( '#body' ),{
                removePlugins: [ 'Heading', 'Link', 'TableToolbar', 'ImageUpload', 'BlockQuote', 'Table',  'MediaEmbed' ],
            } )
            .catch( error => {
                console.error( error );
            } );
    }
</script>
<?php include "includes/admin_footer.php"; ?>
