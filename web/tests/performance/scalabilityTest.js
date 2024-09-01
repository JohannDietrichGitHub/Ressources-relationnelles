import http from 'k6/http';
import { check, sleep } from 'k6';

// URL Ressources Relationnelles
const BASE_URL = 'https://www.ressources-relationnelles.fr/';

export const options = {
  stages: [
    { duration: '1m', target: 10 }, // Monte à 10 utilisateurs en 1 minute
    { duration: '1m', target: 50 }, // Monte à 50 utilisateurs en 1 minute
    { duration: '1m', target: 100 }, // Monte à 100 utilisateurs en 1 minute
    { duration: '1m', target: 0 }, // Redescend à 0 utilisateurs en 1 minute
  ],
};

export default function () {
  const response = http.get(`${BASE_URL}/`); 
  check(response, {
    'Code statut est 200': (r) => r.status === 200,
    'Body contient le texte attendu': (r) => r.body.includes('La plateforme pour améliorer vos relations'), 
  });
  sleep(1); // Attendre 1 seconde entre les requêtes
}
