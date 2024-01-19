# ------ Chattin ------
# http://16.171.27.108

Chattin je jednoduchá aplikace, která umožňuje uživatelům komunikovat mezi sebou v reálném čase. Používá WebSocketové spojení k vytvoření trvalého spojení mezi serverem a klientem, což umožňuje skutečnou komunikaci mezi uživateli.

## Použité technologie

### Chattin je postaven na následujících technologiích:

* Front-End: HTML, CSS, JavaScript
* Back-End: PHP, JavaScript
* Skutečná komunikace: WebSockets
### Funkce aplikace

* Správu reálného času mezi uživateli
* Ověřování uživatelů a správu relací
* Historie zpráv
* Zpětná vazba

# Podrobnosti dokumentace

## Ověřování uživatelů:

* Uživatelé se mohou registrovat a přihlašovat do chatové aplikace.
* Zaregistrovaní uživatelé mají unikátní jméno.

  ![image](https://github.com/MichalStilec/ChatWebNew/assets/113086016/68d172a4-c6fc-4414-9930-4c0fefca5c0a)

  
* Zaregistrovaní uživatelé mají zaheshováné heslo pro bezpečnost.

  ![image](https://github.com/MichalStilec/ChatWebNew/assets/113086016/12bd7177-5101-48b7-b4c1-35d88a70d481)

  
## Skutečná komunikace:

* WebSockets se používají k vytvoření trvalého spojení mezi serverem a klientem.
* Zprávy od jednoho uživatele jsou odesílány všem připojeným uživatelům.
* Odeslané zprávy jsou uloženy do souboru JSON.

  ![image](https://github.com/MichalStilec/ChatWebNew/assets/113086016/c6e1c8d5-31c9-4d2d-b2c9-0266c0c884e3)


## Zpětná vazba:
Úspěšné zprávy se zobrazí uživateli po úspěšných akcích (např. registrace, přihlášení).

![image](https://github.com/MichalStilec/ChatWebNew/assets/113086016/ab939a61-9d29-4d7c-a1ba-3776c4563a9b)

