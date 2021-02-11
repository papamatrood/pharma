

$('document').ready(function () {

    $(this).prop('selected', 'selected');

    //fermer la fénêtre quand on clique sur quitter dans la rubrique fichier
    $("a.quitter").click(function (event) {
        window.close();
    });


    //Remplissage du champ nom de famille par séléction de code famille 
    $('select.codeFamille').change(function(){
        var id = "";
        $('select.codeFamille option:selected').each(function(){
            id += $(this).val();

            $.get('http://127.0.0.1:8000/user/familles/' + id, { id: id }, function (data) {
                $('.nomFamille').val(data.famille); 
            }, "json");

        });
    }).change();


    //Remplissage du champ fournisseur par séléction de numéro (Page commande)
    $('#nFour').change(function () {
        var id = "";
        $('#nFour option:selected').each(function () {
            id += $(this).val();
            numero += $(this).text();

            $.get('http://127.0.0.1:8000/user/fournisseurs/' + id, function (data) {
                $('#fournisseur').val(data.fournisseur);
                $('#numero').val(data.numero);
            }, "json");

        });
    }).change();


    //Remplissage du champ désignation par séléction de code (Page commande)
    $('#codeProd').change(function () {
        var id = "";
        var code = "";
        $('#codeProd option:selected').each(function () {
            id += $(this).val();
            code += $(this).text();

            $.get('http://127.0.0.1:8000/user/produits/' + id, function (data) {
                $('#designation').val(data.designation);
                $('#code').val(data.code);
                $('#pu').val(data.pu);
            }, "json");

        });
    }).change();


    //Fiche individuel de salaire
    $('#salaireMatricule').change(function () {
        var id = "";
        $('#salaireMatricule option:selected').each(function () {
            id += $(this).val();

            $.get('http://127.0.0.1:8000/admin/employes/' + id, function (data) {
                $('#salairePrenomNom').val(data.employe);
                $('#salaireDateNaissance').val(data.naissance);
                $('#salaireNombreEnfant').val(data.enfants);
                $('#salaireTypeContrat').val(data.contrat);
                $('#salaireCategorie').val(data.categorie);
                $('#salaireCivilite').val(data.civilite);
                $('#salaireFonction').val(data.fonction);
                $('#salaireDateEmbauche').val(data.embauche);
                $('#salaireSituationFamiliale').val(data.situation);
            }, "json");

        });
    }).change();


    //Ventes
    $('#client').change(function () {
        var id = "";
        $('#client option:selected').each(function () {
            id += $(this).val();
            numero += $(this).text();

            $.get('http://127.0.0.1:8000/user/clients/' + id, function (data) {
                $('#numero').val(data.numero);
                $('#prenomNom').val(data.prenomNom);
                $('#adresse').val(data.adresse);
                $('#telephone').val(data.telephone);
            }, "json");

        });
    }).change();


    //Suppression d'un produit dans la liste des produits à commander
    $('.suppProduitCommande').click(function (event) {
            event.preventDefault();
            let $that = $(this);
            $that.text('Suppression en cours ...')
            $.get($(this).attr('href'), function() {
            })
            .done(function() {
                $that.parent().parent().fadeOut();
            })
            .fail(function() {
                $that.append("<i class=\"far fa-trash-alt\"></i>")
            })
            .always(function() {
                
            });
    });





});