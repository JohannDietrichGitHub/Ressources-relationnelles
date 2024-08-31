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
  const res = http.get('http://192.162.69.115');
  check(res, {
      'Code statut est 200': (r) => r.status === 200,
      'Body contient le texte suivant': (r) => r.body.includes('La plateforme pour améliorer vos relations'),
  });
}
