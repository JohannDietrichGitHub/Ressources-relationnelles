import http from 'k6/http';
import { check, sleep } from 'k6';
import { Counter } from 'k6/metrics';

// URL Ressources Relationnelles
const BASE_URL = 'https://www.ressources-relationnelles.fr/';

// Lancement du test de stress avec les paliers de charge
// duration : correspond à la durée du test
// target : correspond au nombre d'utilisateurs
export let options = {
    stages: [
        { duration: '1m', target: 100 }, // Monter en charge jusqu'à 100 utilisateurs en 1 minute
        { duration: '1m', target: 100 }, 
        { duration: '10s', target: 0 },  // Redescendre à 0 utilisateurs en 10 secondes
      ],
};

export default function () {
    let res = http.get(`${BASE_URL}/`);
    check(res, {
        'Code statut est 200': (r) => r.status === 200,
        'Body contient le texte suivant': (r) => r.body.includes('La plateforme pour améliorer vos relations'),
    });
    sleep(1);
}
