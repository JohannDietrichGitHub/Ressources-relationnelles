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
  //let res = http.get('https://840d-2a01-cb10-16-3400-a912-f0db-f967-67cc.ngrok-free.app/Ressources-relationnelles/web/public/');
  let res = http.get('http://localhost/Ressources-relationnelles/web/public/');

  check(res, {
    'status est 200': (r) => r.status === 200,
    'body contient le texte attendu': (r) => r.body.includes('La plateforme pour améliorer vos relations'),
  });

  sleep(1);
}
