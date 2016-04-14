			
			function click_user() {					
				$("#txtUtilisateur").hide();
				$("#authent").show();				
			}
			
			function click_authent() {
				var password = $("#psswd").val();
				var usr = $("#utilisateur").val();

				if ("user" != usr || password != "password") {
					$("#ici").text("L'authentification n'est pas correcte. Re-essayer");
						
					return false;
				}
				$("#ici").text("L'authentification est correcte");
					
				$("#authent").hide();
				$("#ligue").show();
					
				return true;
			}
			
			function click_ligue() {			
				var nom_ligue = document.getElementById("nomLigue").value;
				document.form_ligue.idGestionnaire.value = 4;
				var category_ligue = document.getElementById("category_name").value;
				var textOutput = document.getElementById("output_cat_eq");
				textOutput.value = category_ligue;
				
				var nom_ligue = $("#nomLigue").val();
				var nom_sligue = $("#nomsousLigue").val();
				var cat_ligue = $("#category_name").val();
					
				if (nomLigue == "" || nom_sligue == "" || cat_ligue == "" ) {
					alert("Les champs de ligue ne sont pas rempli");
					return false;
				}
				
				
				alert($('#form_ligue').serialize());
				//alert($('form_ligue').serialize());
				$.ajax({
					url:'http://thierrystpierre.ddns.net:81/ProjetAEC/connect_ligue.php',
					type:'post',
					data:$('#form_ligue').serialize(),
					datatype:'json',
					success:function(reponse){ 
						alert(JSON.stringify(reponse));
					}
				});


				alert("La ligue " +nom_ligue +" est créée avec succes");
				
				$("#ligue").hide();
				$("#equipe").show();
				return true;
			}
			
			function click_equipe() {
				var category_equipe = document.getElementById("nomEquipe").value;
				var textOutput = document.getElementById("output_nom_equipe");
				textOutput.value = category_equipe;
			
				var nb_equipe = $("#nombre_equipe").val();
				var nom_equipe = $("#nomEquipe").val();
				var nb_joueur = $("#nombre_joueur").val();
				
				if (nb_equipe == "" || nom_equipe == "" || nb_joueur == "" ) {
					alert("Les champs d'équipe ne sont pas rempli");
					return false;
				}
			
				$("#equipe").hide();
				$("#inscription").show();
				return true;
			}
			
			
			var joueur =[];
			function click_inscription() {
				var nom_joueur = $("#nom_joueur").val();
				var prenom_joueur = $("#prenom_joueur").val();
				var ddn_joueur = $("#ddn_joueur").val();
				var tel_joueur = $("#tel_joueur").val();
				var email_joueur = $("#email_joueur").val();
				var pos_joueur = $("#pos_joueur").val();
				var chand_joueur = $("#chand_joueur").val();
				var data_joueur = null;
				
 				var output_table_joueur = document.getElementById("table_joueur");
				
				data_joueur = nom_joueur +", " +prenom_joueur +", " +ddn_joueur +", " +tel_joueur +", "
				+email_joueur +", " +pos_joueur +", " +pos_joueur +", " +chand_joueur +".";
				
				joueur.push(data_joueur);		

				
				for (i = 0; i < joueur.length; i++ ) {
					document.getElementById('table_joueur').value = joueur[i] +"\n";
				}
				
				
				
				
				
				/* remettre a blanc les champs d'entree */
				document.getElementById('nom_joueur').value = '';
				document.getElementById('prenom_joueur').value = '';
				document.getElementById('ddn_joueur').value = '';
				document.getElementById('tel_joueur').value = '';
				document.getElementById('email_joueur').value = '';
				document.getElementById('pos_joueur').value = '';
				document.getElementById('chand_joueur').value = '';
				
				
				

			}
			
			
