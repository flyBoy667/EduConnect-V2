<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property string $titre
 * @property string $contenu
 * @property string $dateDebut
 * @property string $dateFin
 * @property string|null $image
 * @property string $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Annonce newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Annonce newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Annonce query()
 * @method static \Illuminate\Database\Eloquent\Builder|Annonce whereContenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Annonce whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Annonce whereDateDebut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Annonce whereDateFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Annonce whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Annonce whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Annonce whereTitre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Annonce whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Annonce whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperAnnonce {}
}

namespace App\Models{
/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel query()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperBaseModel {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property string $user_id
 * @property string $filiere_id
 * @property float $etat_paiement
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\EtudiantFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Etudiant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Etudiant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Etudiant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Etudiant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Etudiant whereEtatPaiement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Etudiant whereFiliereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Etudiant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Etudiant whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Etudiant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Etudiant whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperEtudiant {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property string $nom_filiere
 * @property string|null $description
 * @property float $montant_formation
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Filiere newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Filiere newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Filiere query()
 * @method static \Illuminate\Database\Eloquent\Builder|Filiere whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Filiere whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Filiere whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Filiere whereMontantFormation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Filiere whereNomFiliere($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Filiere whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperFiliere {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property string $nom_cours
 * @property string|null $description
 * @property string $professeur_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Module newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Module newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Module query()
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereNomCours($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereProfesseurId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperModule {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property string $etudiant_id
 * @property string $personnel_administratif_id
 * @property float $montant
 * @property string $type
 * @property string $date
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Paiement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Paiement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Paiement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Paiement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paiement whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paiement whereEtudiantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paiement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paiement whereMontant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paiement wherePersonnelAdministratifId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paiement whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paiement whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paiement whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperPaiement {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property string $user_id
 * @property int $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\PersonnelAdministratifFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|PersonnelAdministratif newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonnelAdministratif newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonnelAdministratif query()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonnelAdministratif whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonnelAdministratif whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonnelAdministratif whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonnelAdministratif whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonnelAdministratif whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperPersonnelAdministratif {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property string $user_id
 * @property string $specialites
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\ProfesseurFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Professeur newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Professeur newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Professeur query()
 * @method static \Illuminate\Database\Eloquent\Builder|Professeur whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professeur whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professeur whereSpecialites($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professeur whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professeur whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperProfesseur {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property string $module_id
 * @property string $professeur_id
 * @property string $etudiant_id
 * @property string $description
 * @property string $date
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Reclamation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reclamation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reclamation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reclamation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reclamation whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reclamation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reclamation whereEtudiantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reclamation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reclamation whereModuleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reclamation whereProfesseurId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reclamation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reclamation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperReclamation {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property string $module_id
 * @property string $nom
 * @property string $fichier
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Ressource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ressource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ressource query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ressource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ressource whereFichier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ressource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ressource whereModuleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ressource whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ressource whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperRessource {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property string $nom
 * @property string $prenom
 * @property string $login
 * @property string $email
 * @property string $telephone
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePrenom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperUser {}
}

