--
-- Database: `ramnij_excetaste`
--
CREATE DATABASE IF NOT EXISTS `ramnij_excetaste` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ramnij_excetaste`;

--
-- Gegevens worden geëxporteerd voor tabel `Bestelling`
--

INSERT INTO `Bestelling` (`Tafel`, `Datum`, `Tijd`, `MenuCodeItem`, `Aantal`, `Prijs`, `Klaargemaakt`) VALUES
('1', '20-04-16', '19:00', '38', 2, '11.95', 1),
('1', '20-04-16', '19:00', '9', 2, '3.95', 0),
('2', '20-04-16', '18:00', '30', 2, '4.95', 1),
('2', '20-04-16', '18:00', '41', 2, '11.95', 1),
('2', '20-04-16', '18:00', '8', 2, '2.95', 0);

--
-- Gegevens worden geëxporteerd voor tabel `Bon`
--

INSERT INTO `Bon` (`Tafel`, `Datum`, `Tijd`, `Betalingswijze`) VALUES
('2', '20-04-16', '18:00', 'pin');

--
-- Gegevens worden geëxporteerd voor tabel `Gerecht`
--

INSERT INTO `Gerecht` (`Gerechtcode`, `Gerecht`) VALUES
('2', 'Dranken'),
('3', 'Hapjes'),
('4', 'Voorgerechten'),
('5', 'Hoofdgerechten'),
('6', 'Nagerechten');

--
-- Gegevens worden geëxporteerd voor tabel `Klant`
--

INSERT INTO `Klant` (`klantid`, `Klantnaam`, `Telefoon`) VALUES
('1', 'Jansen', '0612345678'),
('2', 'Faoud', '0369876543'),
('3', 'Mevrouw Pietersen', '0366543987'),
('4', 'Van den Ouden', '0678901234'),
('5', 'Boodaart', '0698769876'),
('6', 'J. de la Guiterraz', '03654321987');

--
-- Gegevens worden geëxporteerd voor tabel `MenuItem`
--

INSERT INTO `MenuItem` (`GerechtCode`, `SubgerechtCode`, `MenuItemCode`, `MenuItem`, `Prijs`) VALUES
('2', '1', '1', 'Koffie', '2.57'),
('2', '1', '2', 'Thee', '2.57'),
('2', '1', '3', 'Chocolademelk', '3.10'),
('2', '1', '4', 'Espresso', '2.57'),
('2', '1', '5', 'Cappuccino', '2.89'),
('2', '1', '6', 'Koffie verkeerd', '3.10'),
('2', '1', '7', 'Latte macchiato', '4.15'),
('2', '2', '10', 'Pilsner', '2.95'),
('2', '2', '11', 'Weizen', '3.95'),
('2', '2', '12', 'Stender', '2.95'),
('2', '2', '13', 'Palm', '3.60'),
('2', '2', '14', 'Kasteel donker', '4.75'),
('2', '2', '8', 'Brugse zot', '3.95'),
('2', '2', '9', 'Grimbergen dubbel', '3.95'),
('2', '3', '15', 'Per glas', '4.54'),
('2', '3', '16', 'Per fles', '20.64'),
('2', '3', '17', 'Seizoenswijn', '4.54'),
('2', '3', '18', 'Rode port', '4.14'),
('2', '4', '19', 'Tonic', '2.95'),
('2', '4', '20', 'Seven Uo', '2.95'),
('2', '4', '21', 'Verse jus', '3.95'),
('2', '4', '22', 'Chaudfontaine rood', '2.75'),
('2', '4', '23', 'Chaudfontaine blauw', '2.75'),
('3', '5', '24', 'Bitterballen met mosterd', '4.40'),
('3', '5', '25', 'Vlammetjes met chilisaus', '4.40'),
('3', '5', '26', 'Kipbites', '5.50'),
('3', '6', '27', 'Portie kaas met mosterd', '4.40'),
('3', '6', '28', 'Brood met kruidenboter', '5.50'),
('3', '6', '29', 'Portie salami worst', '4.40'),
('3', '7', '48', 'Kipnuggets met chilisaus', '4.20'),
('4', '7', '30', 'Tomatensoep', '5.20'),
('4', '7', '31', 'Groentesoep', '4.15'),
('4', '7', '32', 'Aspergesoep', '5.20'),
('4', '7', '33', 'Uiensoep', '4.15'),
('4', '8', '34', 'Salade met geitenkaas', '5.45'),
('4', '8', '35', 'Tonijnsalade', '6.55'),
('4', '8', '36', 'Zalmsalade', '6.55'),
('5', '10', '38', 'Gebakken makreel', '9.85'),
('5', '10', '39', 'Mosselen uit pan', '10.95'),
('5', '11', '41', 'Biefstuk in champignonsaus', '12.19'),
('5', '11', '42', 'Wienerschnitzel', '10.15'),
('5', '9', '36', 'Bonengerecht met diverse groenten', '12.55'),
('5', '9', '37', 'Gebakken banaan', '11.50'),
('6', '12', '43', 'Black Lady', '5.45'),
('6', '12', '44', 'Vruchtenijs', '3.25'),
('6', '13', '45', 'Chocolademousse', '5.20'),
('6', '13', '46', 'Vanillemousse', '4.15');

--
-- Gegevens worden geëxporteerd voor tabel `Reservering`
--

INSERT INTO `Reservering` (`Tafel`, `Datum`, `Tijd`, `KlantId`, `Aantal`) VALUES
('1', '20-04-16', '19:00', '1', '2'),
('2', '20-04-16', '18:00', '3', '4'),
('3', '20-04-16', '19:00', '2', '2'),
('4', '21-04-16', '18:00', '6', '6'),
('5', '21-04-16', '17:00', '5', '2');

--
-- Gegevens worden geëxporteerd voor tabel `Subgerecht`
--

INSERT INTO `Subgerecht` (`GerechtCode`, `SubgerechtCode`, `Subgerecht`) VALUES
('2', '1', 'Warme dranken'),
('2', '2', 'Bieren'),
('2', '3', 'Huiswijnen'),
('2', '4', 'Frisdranken'),
('3', '5', 'Warme hapjes'),
('3', '6', 'Koude hapjes'),
('4', '7', 'Warme voorgerechten'),
('4', '8', 'Koude voorgerechten'),
('5', '10', 'Vleesgerechten'),
('5', '11', 'Vegetarische gerechten'),
('5', '9', 'Visgerechten'),
('6', '12', 'IJs'),
('6', '13', 'Mousse');
