import http from 'k6/http';
import { check, sleep } from 'k6';

export let options = {
  stages: [
    { duration: '30s', target: 10 },
    { duration: '1m', target: 10 },
    { duration: '30s', target: 0 },
  ],
};

export default function () {
  let res = http.get('https://7e8e-2a01-cb10-16-3400-d837-4f0e-2c26-aec5.ngrok-free.app/Ressources-relationnelles/web/public/'); // Fonctionne uniquement si URL ngrok mis à jour
 // let res = http.get('http://localhost/Ressources-relationnelles/web/public/'); # Fonctionne en local, mais pas par GitHub Actions

  check(res, {
    'status est 200': (r) => r.status === 200,
    'body contient le texte attendu': (r) => r.body.includes('La plateforme pour améliorer vos relations'),
  });

  sleep(1);
}
