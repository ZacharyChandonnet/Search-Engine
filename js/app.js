/**
 * @module App
 */
export default class App {
    /**
     * Méthode principale. Sera appelée après le chargement de la page.
     */
    static main() {
        $(document).ready(function () {
            $('.activite-link').click(function (e) {
                e.preventDefault();
                $(this).next('.sous-menu').slideToggle();
            });
        });
    }
    /**
     * Méthode qui permet d'attendre le chargement de la page avant d'éxécuter le script principal
     * @returns undefined Ne retourne rien
    */
    static init() {
        window.addEventListener("load", () => {
            this.main();
        });
    }
}
App.init();
