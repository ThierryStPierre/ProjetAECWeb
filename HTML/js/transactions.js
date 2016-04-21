			
			function click_user() {					
				$("#txtUtilisateur").hide();
				$("#authent").show();				
			}
			
			function click_authent() {
				/* saisir les entrees de authentification */
				var password = $("#psswd").val();
				var usr = $("#utilisateur").val();

				/*********************************************
				if ("user" != usr || password != "password") {
					$("#ici").text("L'authentification n'est pas correcte. Re-essayer");
					return false;
				}
				$("#ici").text("L'authentification est correcte");
				*********************************************/
				
				
				if (usr == "" || password == "") {
					alert("Les champs d'authentification sont requis");
					document.form_authent.utilisateur.focus(); 
					return false;
				}
				
				alert($('#form_authent').serialize());

				$.ajax({
					url:'http://thierrystpierre.ddns.net:81/ProjetAEC/limuxReader.php',
					type:'post',
					data:$('#form_authent').serialize(),
					datatype:'json',
					success:function(reponse){ 
		
						var obj = JSON.parse(reponse);
						if (obj.hasOurProperty("Status"))
							if (obj.hasOurProperty("Id"))
								form.$(ID_Ligue).value = obj["id"];
								
						alert(JSON.stringify(reponse));		
					}
				});

				alert("L'authentification est correcte");
				
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
					alert("Les champs de ligue sont requis");
					return false;
				}
		
				alert($('#form_ligue').serialize());

				$.ajax({
					url:'http://thierrystpierre.ddns.net:81/ProjetAEC/limuxWriter.php',
					type:'post',
					data:$('#form_ligue').serialize(),
					datatype:'json',
					success:function(reponse){ 
		
						var obj = JSON.parse(reponse);
						if (obj.hasOurProperty("Status"))
							if (obj.hasOurProperty("Id"))
								form.$(ID_Ligue).value = obj["id"];
					
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
					alert("Les champs d'équipe sont requis");
					return false;
				}
				
				alert($('#form_equipe').serialize());

				$.ajax({
					url:'http://thierrystpierre.ddns.net:81/ProjetAEC/limuxWriter.php',
					type:'post',
					data:$('#form_equipe').serialize(),
					datatype:'json',
					success:function(reponse){
											
						
						var obj = JSON.parse(reponse);
						if (obj.hasOurProperty("Status"))
							if (obj.hasOurProperty("Id"))
								form.$(ID_Equipe).value = obj["id"];
								

						alert(JSON.stringify(reponse));
					}
				});

				alert("L'équipe " +nom_equipe +" est créé avec succes");
		
				$("#equipe").hide();
				$("#inscription").show();
				return true;
			}

			var message = "";
			var prompt = 0;
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
				var nombre = document.form_inscription.telephone.value;
				var chiffres = new String(nombre);
				var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
				var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
				var num_chandail = document.form_inscription.numeroChandail.value;
				
				var data_joueur = null;
				var str = "";
				var Jlenght;
				
				if (nom_joueur == "" || prenom_joueur == "" || ddn_joueur == "" || tel_joueur == "" || email_joueur == "" || pos_joueur == "" || chand_joueur == "") {
					alert("Les champs d'inscription joueur sont requis");
					return false;
				}
				
				/* valider la date */
				var dateInput = document.getElementById('dateDeNaissance').value;
				validerDate(dateInput);
				
				if (prompt == 1) {
					prompt = 0;
					alert(message);
					document.form_inscription.dateDeNaissance.focus();
					return false;					
				}
				
				if(!document.form_inscription.telephone.value.match(phoneno))
				{  /* valider le telephone */
					alert("Assurez-vous de rentrer un numéro à 10 chiffres (xxx-xxx-xxxx)"); 
					document.form_inscription.telephone.focus(); 
					return false;  
				}  
				
				if (!document.form_inscription.courriel.value.match(mailformat))  
				{  /* valider le courriel */
					alert("Vous avez entré un courriel non valide !\nRéentrez votre courriel, SVP");  
					document.form_inscription.courriel.focus(); 
					return false;
				}

				if (isNaN(parseInt(num_chandail))) //num_chandail n'est pas un nombre
				{  /* valider le numero Chandail */
					alert("Vous avez entré un numero Chandail non valide !\nRéentrez votre numero Chandail, SVP");
					document.form_inscription.numeroChandail.focus();
					return false;
				}

				data_joueur = nom_joueur +", " +prenom_joueur +", " +ddn_joueur +", " +tel_joueur +", "
				+email_joueur +", " +pos_joueur +", " +chand_joueur +".";

				joueur.push(data_joueur);	
				Jlenght = joueur.length;
				str = document.getElementById("table_joueur");
				str.innerHTML = joueur.join('<br />'); // afficher dans la boite du droit

				
				alert($('#form_inscription').serialize());

				$.ajax({
					url:'http://thierrystpierre.ddns.net:81/ProjetAEC/limuxWriter.php',
					type:'post',
					data:$('#form_inscription').serialize(),
					datatype:'json',
					success:function(reponse){
					
					
						var obj = JSON.parse(reponse);
						if (obj.hasOurProperty("Status"))
							if (obj.hasOurProperty("Id"))
								form.$(ID_Joueur).value = obj["id"];
					
					
						alert(JSON.stringify(reponse));
					}
				});

				alert("Le joueur " +nom_joueur +" est créé avec succes");
		
				/* remettre a blanc les champs d'entree */
				document.getElementById('nom').value = '';
				document.getElementById('prenom').value = '';
				document.getElementById('dateDeNaissance').value = '';
				document.getElementById('telephone').value = '';
				document.getElementById('courriel').value = '';
				document.getElementById('position').value = '';
				document.getElementById('numeroChandail').value = '';
				
				/* désactiver les champs d'entree */
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
			
			function click_quitter(){
				window.close();
			}
			
			function validerDate(maDate) {
				var dateformat =/^([0-9]{4})\/(0?[1-9]|1[0-2])\/(0?[1-9]|1[0-9]|2[0-9]|3[0-1])$/;  // format YYYY/MM/DD
				var ListofDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
				var thedate, day, month, year;
				thedate = maDate.split('/');
			
				year = parseInt(thedate[0]);
				month = parseInt(thedate[1]);
				day = parseInt(thedate[2]);
			
				if (maDate.match(dateformat)) {
					if (month == 1 || month > 2) {
						if (day > ListofDays[month - 1]) {
							message = 'La date est non valide!';
							prompt = 1; 
							return false;
						}
					}
				
					if (month == 2) {
						var leapYear = false;
						
						if ((!(year % 4) && year % 100) || !(year % 400)) {
							leapYear = true;
						}

						if ((leapYear == false) && (day >= 29)) {
							message = "L'année n'est pas bissectile!\nLa date doit être le 28";
							prompt = 1; 
							return false;
						}

						if ((leapYear == true) && (day > 29)) {
							message = 'La date est non valide!';
							prompt = 1; 
							return false;
						}
					}
				}
				else {
					message = "Vous avez entré une date avec format non valide !\nFormat yyyy/mm/dd (ex.: 2016/01/31)"; 
					prompt = 1;
					return false;
				}
			}
			
			
			
				
			