<?php 

define ('SAVED' , "<div class='alert alert-success'>Enregistré
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
							</button>
						</div>");

define('MODIF_ERR', "<div class='alert alert-danger'>Erreur de modifier
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
							</button>
						</div>");

define('GET_VALUE_ERR', "<div class='alert alert-danger'>Erreur de récupérer la valeur
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
							</button>
						</div>");
	
define('GET_VALUE_FORM_ERR', "<div class='alert alert-danger'>Erreur d'ajouter
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
								</button>
							</div>");
	
define('DATE_INVALIDE', "<div class='alert alert-danger' role='alert'>
							<strong>Date non valide,</strong> la date saisie doit être se situer entre la dernière date de retour de ce matériel et la date aujourd'hui.
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
							</button>
						</div>");
						
define('DATE_NEWER_THAN_TODAY', "<div class='alert alert-danger' role='alert'>
									<strong>Date non valide,</strong> la date saisie ne peut pas être supérieure qu'aujourd'hui.
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
										<span aria-hidden='true'>&times;</span>
									</button>
								</div>");

define('DATE_OLDER_THAN_DATELOAN', "<div class='alert alert-danger' role='alert'>
										<strong>Date non valide,</strong> la date saisie doit être se situer entre la date d'emprunt et la date aujourd'hui.
										<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
											<span aria-hidden='true'>&times;</span>
										</button>
									</div>");