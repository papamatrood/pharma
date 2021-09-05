

$('document').ready(function () {

    $(this).prop('selected', 'selected');


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

            var jqxhr = $.get('http://127.0.0.1:8000/user/fournisseurs/' + id, function () {
            })
                .done(function (data) {
                    $('#fournisseur').val(data.fournisseur);
                    $('#numero').val(data.numero);
                })
                .fail(function () {
                    alert("error");
                })
                .always(function () {
                });

        });
    }).change();
    


    //Remplissage du champ désignation par séléction de code (Page commande)
    $('#codeProd').change(function () {
        var id = "";
        var code = "";
        $('#codeProd option:selected').each(function () {
            id += $(this).val();
            code += $(this).text();

            var jqxhr = $.get('http://127.0.0.1:8000/user/produits/' + id, function () {
            })
                .done(function (data) {
                    $('#designation').val(data.designation);
                    $('#code').val(data.code);
                    $('#pu').val(data.pu);
                })
                .fail(function () {
                    alert("error");
                })
                .always(function () {
                });

        });
    }).change();


    //Fiche individuel de salaire
    $('#salaireMatricule').change(function () {
        var id = "";
        $('#salaireMatricule option:selected').each(function () {
            id += $(this).val();

            $.get('http://127.0.0.1:8000/admin/employes/' + id, function () {
            })
                .done(function (data) {
                    $('#salairePrenomNom').val(data.employe);
                    $('#salaireDateNaissance').val(data.naissance);
                    $('#salaireNombreEnfant').val(data.enfants);
                    $('#salaireTypeContrat').val(data.contrat);
                    $('#salaireCategorie').val(data.categorie);
                    $('#salaireCivilite').val(data.civilite);
                    $('#salaireFonction').val(data.fonction);
                    $('#salaireDateEmbauche').val(data.embauche);
                    $('#salaireSituationFamiliale').val(data.situation);
                })
                .fail(function () {
                    alert("Erreur de chargement des informations l'employé d'id : " + id);
                })
                .always(function () {
                });

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


    //Ajout d'un produit dans la liste des produits à commander
    $('.commandeFormulaire').submit(function (event) {
        event.preventDefault();
        let $form = $(this);
        $form.find('button').text('Chargement...');
        $.get($form.attr('action'), $form.serializeArray())
            .done(function (data) {
                let $id = $('#codeProd').val();
                let $href = "http://127.0.0.1:8000/admin/commandes/supprimer/" + $id;
                let $a = ('<a class="btn btn-outline-danger suppProduitCommande" href="' + $href + '">' +
                    'Supprimer' +
                    '</a >')
                let $row = ('<tr>' +
                    '<td>' + data.code + '</td>' +
                    '<td>' + data.designation + '</td>' +
                    '<td>' + data.quantite + '</td>' +
                    '<td>' + $a + '</td>' +
                    '</tr>');
                $('.pasDenregistrement').hide().fadeOut('slow');
                $('table.listeDesProduitsACommander tbody').append($row).hide().fadeIn('slow');
                $('.suppProduitCommande').html('<i class="far fa-trash-alt"></i>');
        })
        .fail(function() {
            alert("Echec !");
        })
        .always(function() {
            $form.find('button').text('Valider');
        });
    });


    //Suppression d'un produit dans la liste des produits à commander
    $(document).on('click', '.suppProduitCommande', function (event) {
        event.preventDefault();
        let $that = $(this);
        $that.text('Suppression en cours ...')
        $.get($(this).attr('href'), function () {
        })
            .done(function () {
                $that.parent().parent().fadeOut('slow');

                $('.alert-success').show("slow").delay(2000).fadeOut("slow");
            })
            .fail(function () {
                $that.append("<i class=\"far fa-trash-alt\"></i>")
            })
            .always(function () {
                $(function () {
                    let $tds = document.querySelectorAll('.suppProduitCommande');
                    alert($tds.length)
                }).change();
            });
    });


    // Fermer l'onglet

    $('#quitter').on('click', function (event) {
        event.preventDefault();
        if (confirm("Êtes vous sûr de vouloir fermer l'onglet ?")) {
            var myWindow = window.open("", "_self");
            myWindow.document.write("");
            setTimeout(function () { myWindow.close(); }, 1000);
        }
    });




});