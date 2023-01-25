<img width="713" alt="hotel-bo-bo" src="https://user-images.githubusercontent.com/112776922/214508051-aad13ddc-01e6-4238-8fad-a22030fe66c0.png">

# HOTEL BO-BO
Built with php, sql, javascript, html &amp; css

Christmas assignment of building a hotel-booking site.


Feedback till Anna

Inspirerande kod u har skrivit Anna! Din struktur har en väldigt fin ordning och reda och jag har en del att lära mig av din struktur!!

1. Du har en tom js.fil I javascript mappen. Jag kan därmed inte kolla vad du har för js kod:)

2. I din form om du inte vill ha Budget som förinställt val så kan du ha en option ovanför den som är skriven så här:<option disabled selected value=>Select a room!</option>.Detta kan vara bra ifall du skulle få buggar med att isset redan är satt på rummet eftersom det är förinställt till budget från början.

3. I din checkinput.php på rad 40 till 55, så har du 3st else echo med errorkod! Jag tror det kanske hade varit smidigare att ha den specifika errorkoden i den relevanta funktionen. Alltså att "Sorry, your Transfer Code is not written in a valid format, try again."; echon sker i transfercode funktionen etc.På detta vis så hade din if sats bara behövt se ut så här: if ($isTransferCodeTrue && $depositToHotel) { insertIntoDb($name, $transferCode, $arrival, $departure, $room, $total_fee);}

4 I din availability funktion så ser jag inte huruvida du kollar alla datum mellan arrival och departure och returnera false ifall någon av datumen däremellan krockar med bokningens arrival och departure?Om jag inte missat att du gör detta någon annan stans så betyder detta att man hade kunnat boka ett datum mellan en redan existerande arrival och departure.


