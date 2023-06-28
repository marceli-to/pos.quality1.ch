export default {
  
  data() {
    return {

      de: {
        'btn_upload_picture': 'Jetzt Foto hochladen',
        'btn_upload_now': 'Foto jetzt hochladen',
        'btn_cancel': 'Abbrechen',
        'btn_order_now': 'Jetzt neues POS-Material bestellen',
        'btn_more': 'Weitere Fotos anzeigen',
        'btn_submit_order': 'Bestellung abschicken',
        'dropzone_label': 'Foto auswählen oder hierhin ziehen',
        'dropzone_restrictions': 'JPG, PNG | max. Grösse 8 MB',
        'preview': 'Vorschau',
        'delete_preview': 'Foto löschen',
        'placeholder_company': 'Firma',
        'placeholder_name': 'Name',
        'placeholder_email': 'E-Mail',
        'placeholder_message': 'Grussbotschaft',
        'session_expired': 'Ihre Sitzung ist abgelaufen. Seite wird neu geladen',
        'validation_global': 'Es sind Fehler aufgetreten!',
        'company_required': 'Firma wird benötigt!',
        'name_required': 'Name wird benötigt!',
        'email_required': 'E-Mail wird benötigt!', 
        'email_invalid': 'E-Mail unültig',
        'email_in_use': 'E-Mail wird bereits verwendet',
        'image_required': 'Bild wird benötigt',
        'image_exceeds_max_size': 'Bild zu gross (max. 8 MB)',
        'image_type_not_allowed': 'Dateityp nicht erlaubt (nur JPG/PNG)',
        'image_max_files_exceeded': 'Nur 1 Bild erlaubt',
        'accept_tos': 'Bitte Teilnahmebedingungen akzeptieren',
        'tos': 'Ich bin damit einverstanden, dass meine Informationen und mein Bild öffentlich zugänglich und geteilt werden darf.',
        'notification_success': 'Vielen Dank für Ihren Beitrag. Wir werden diesen prüfen und freischalten.',
        'characters': 'Zeichen',
        'characters_limit': 'max. 100 Zeichen',
        'like': 'Like',
        'share': 'Teilen',
        'share_title': 'Quality1 mit neuem Auftritt',
        'share_body': 'Like mein Bild und hilf mir dabei, einen Brunch für mein Team zu gewinnen!',
        'url_copied': 'Link kopiert',
        'url_copy': 'Link kopieren'
      },

      fr: {
        'btn_upload_picture': 'Télécharger une photo',
        'btn_upload_now': 'Télécharger la photo',
        'btn_cancel': 'Annuler',
        'btn_more': 'Voir plus de photos',
        'dropzone_label': 'Sélectionner une photo ou la faire glisser ici',
        'dropzone_restrictions': 'JPG, PNG | taille max. 4 Mo',
        'preview': 'Aperçu',
        'delete_preview': 'Supprimer la photo',
        'placeholder_company': 'Entreprise',
        'placeholder_name': 'Nom',
        'placeholder_email': 'E-mail',
        'placeholder_message': 'Message de salutation',
        'session_expired': 'Votre session a expiré. La page sera rechargée.',
        'validation_global': 'Des erreurs sont survenues!',
        'company_required': 'Entreprise requise!',
        'name_required': 'Nom requis!',
        'email_required': 'E-mail requis!', 
        'email_invalid': 'E-mail invalide',
        'email_in_use': 'E-mail déjà utilisé',
        'image_required': 'Photo requise',
        'image_exceeds_max_size': 'Photo de trop grande taille (max. 8 Mo)',
        'image_type_not_allowed': 'Type de fichier non autorisé (uniquement JPG/PNG)',
        'image_max_files_exceeded': 'Uniquement 1 photo autorisée',
        'accept_tos': 'Veuillez accepter les conditions de participation',
        'tos': 'J’accepte que mes données et ma photo soient accessibles au public et qu’elles soient partagées.',
        'notification_success': 'Merci de votre contribution. Nous allons l’examiner et la publier.',
        'characters': 'Caractères',
        'characters_limit': 'Max. 100 caractères',
        'like': 'J’aime',
        'share': 'Partager',
        'share_title': 'Quality1 a 20 ans',
        'share_body': 'Like ma photo et aide-moi à gagner un brunch pour mon équipe!',
        'url_copied': 'Lien copié',
        'url_copy': 'Copier le lien'
      },
      
      it: {
        'btn_upload_picture': 'Caricate ora la foto',
        'btn_upload_now': 'Caricate ora la foto',
        'btn_cancel': 'Annulla',
        'btn_more': 'Mostra altre foto',
        'dropzone_label': 'Seleziona o trascina foto',
        'dropzone_restrictions': 'JPG, PNG | Dimensioni max 8 MB',
        'preview': 'Anteprima',
        'delete_preview': 'Elimina foto',
        'placeholder_company': 'Azienda',
        'placeholder_name': 'Nome',
        'placeholder_email': 'E-mail',
        'placeholder_message': 'Messaggio di saluto',
        'session_expired': 'La tua sessione è scaduta. La pagina si sta ricaricando.',
        'validation_global': 'Si sono verificati degli errori!',
        'company_required': 'È necessario indicare l’azienda!',
        'name_required': 'È necessario indicare il nome!',
        'email_required': 'È necessario indicare l’e-mail!', 
        'email_invalid': 'E-mail non valida',
        'email_in_use': 'E-mail già utilizzata',
        'image_required': 'È necessario inserire una foto',
        'image_exceeds_max_size': 'Dimensioni della foto troppo grandi (max 8 MB)',
        'image_type_not_allowed': 'Formato del file non consentito (solo JPG/PNG)',
        'image_max_files_exceeded': 'È consentita una sola foto',
        'accept_tos': 'Si prega di accettare le condizioni di partecipazione',
        'tos': 'Acconsento a rendere pubbliche le mie informazioni e la mia foto, che potranno essere condivise da terzi.',
        'notification_success': 'Grazie per i contenuti che ci ha inviato. Provvederemo a verificarli e ad autorizzarne la pubblicazione.',
        'characters': 'Caratteri',
        'characters_limit': 'Max 100 caratteri',
        'like': 'Mi piace',
        'share': 'Condividi',
        'share_title': '20 anni di Quality1',
        'share_body': 'Metti «Mi piace» alla mia foto e aiutami a vincere un brunch per il mio team!',
        'url_copied': 'Link copiato',
        'url_copy': 'Copiare il link'
      }
    }
  },

  methods: {

    l18n(key) {
      return this[this.getLocale()][key];
    },

    getLocale() {
      let ll = document.documentElement.lang ? document.documentElement.lang : 'de';
      return ll;
    },
  }
};