			
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
			/* (pour test) ceci devrait implanter une fois idGestionnaire est créé */
				document.form_ligue.idGestionnaire.value = 4;

			
				var nom_ligue = document.getElementById("nomLigue").value;
				var category_ligue = document.getElementById("category_name").value;
				var category_output = document.getElementById("output_cat_eq");
				category_output.value = category_ligue;
				
				/* saisir les entrees de ligue */
				var nom_ligue = $("#nomLigue").val();
				var nom_sligue = $("#nomsousLigue").val();
				var cat_ligue = $("#category_name").val();
					
				if (nom_ligue == "" || nom_sligue == "" || cat_ligue == "" ) {
					alert("Les champs de ligue ne sont pas rempli");
					return false;
				}
				
				
				alert($('#form_ligue').serialize());

				$.ajax({
					url:'http://thierrystpierre.ddns.net:81/ProjetAEC/limuxWriter.php',
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
			/* (pour test) ceci devrait implanter une fois idLigue est transféré */
				document.form_equipe.idLigue.value = 30;

			
				/* afficher le nom d'equipe au prochain panneau */
				var nom_equipe = document.getElementById("nomEquipe").value;
				var textOutput = document.getElementById("output_nom_equipe");
				textOutput.value = nom_equipe;
			
				/* saisir les entrees d'equipe */
				var nb_equipe = $("#nombre_equipe").val();
				var nom_equipe = $("#nomEquipe").val();
				var nb_joueur = $("#nombre_joueur").val();
				
				if (nb_equipe == "" || nom_equipe == "" || nb_joueur == "" ) {
					alert("Les champs d'équipe ne sont pas rempli");
					return false;
				}
				
				alert($('#form_equipe').serialize());

				$.ajax({
					url:'http://thierrystpierre.ddns.net:81/ProjetAEC/limuxWriter.php',
					type:'post',
					data:$('#form_equipe').serialize(),
					datatype:'json',
					success:function(reponse){ 
						alert(JSON.stringify(reponse));
					}
				});


				alert("L'équipe " +nom_equipe +" est créé avec succes");
		
				$("#equipe").hide();
				$("#inscription").show();
				return true;
			}



			
			
			var joueur =[];
			function click_inscription() {
			/* (pour test) ceci devrait implanter une fois idLigue est transféré */
				document.form_inscription.nomUsager.value = "user";
				document.form_inscription.motDePasse.value = "password";
				document.form_inscription.capitaine.value = true;
				document.form_inscription.pointeur.value = true;
				document.form_inscription.gestionnaire.value = true;
				
			
				/* saisir les entrees d'inscription */
				var nom_joueur = $("#nom").val();
				var prenom_joueur = $("#prenom").val();
				var ddn_joueur = $("#dateDeNaissance").val();
				var tel_joueur = $("#telephone").val();
				var email_joueur = $("#courriel").val();
				var pos_joueur = $("#position").val();
				var chand_joueur = $("#numeroChandail").val();
				var nb_joueur = $("#nombre_joueur").val(); /* valeur du panneau d'equipe */
				
				var data_joueur = null;
				var str = "";
				var Jlenght;
				var couleur;

				data_joueur = nom_joueur +", " +prenom_joueur +", " +ddn_joueur +", " +tel_joueur +", "
				+email_joueur +", " +pos_joueur +", " +", " +chand_joueur +".";
				
				joueur.push(data_joueur);	
				Jlenght = joueur.length;
				
				/* changer de couleur pour faciliter la visualisation */
				str = document.getElementById("table_joueur");
				if (Jlenght%2 == 0 ) {
					str.innerHTML = "<span style='color:'#f1f1a9'>" +joueur.join('<br />'  + "</span>");
				}
				else {
					str.innerHTML = "<span style='color:'#f5f571'>" +joueur.join('<br />'  + "</span>");
				}
				
				
			//	str = document.getElementById("table_joueur");
			//	str.innerHTML = "<span style='color:'#f5f571'>" +joueur.join('<br />'  + "</span>");
				
				
				alert("content of " +str)
				//str.innerHTML = joueur.join('<br />');
			

				
		/* -----------------------------------------------------			
				alert($('#form_inscription').serialize());

				$.ajax({
					url:'http://thierrystpierre.ddns.net:81/ProjetAEC/limuxWriter.php',
					type:'post',
					data:$('#form_inscription').serialize(),
					datatype:'json',
					success:function(reponse){ 
						alert(JSON.stringify(reponse));
					}
				});

				alert("Le joueur " +nom_joueur +" est créé avec succes");
		----------------------------------------------------- */
		
				
				/* remettre a blanc les champs d'entree */
				document.getElementById('nom').value = '';
				document.getElementById('prenom').value = '';
				document.getElementById('dateDeNaissance').value = '';
				document.getElementById('telephone').value = '';
				document.getElementById('courriel').value = '';
				document.getElementById('position').value = '';
				document.getElementById('numeroChandail').value = '';
				
				/* deactiver les champs d'entree */
				if (Jlenght == nb_joueur) {
					document.getElementById('nom').disabled = true;
					document.getElementById('prenom').disabled = true;
					document.getElementById('dateDeNaissance').disabled = true;
					document.getElementById('telephone').disabled = true;
					document.getElementById('courriel').disabled = true;
					document.getElementById('position').disabled = true;
					document.getElementById('numeroChandail').disabled = true;
					alert("Le total des " +nb_joueur +" joueurs sont enregistrés.");
				}
				
				

			}
			
			
