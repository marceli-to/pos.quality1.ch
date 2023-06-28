import FingerprintJS from '@fingerprintjs/fingerprintjs';

// (async () => {
//   const fp = await FingerprintJS.load();

//   // Get a visitor identifier when you'd like to.
//   const result = await fp.get();

//   // This is the visitor identifier:
//   const hash = result.visitorId;

//   // Get CSRF token
//   let token = document.head.querySelector('meta[name="csrf-token"]');

//   // Store hash
//   let response = fetch('/api/voter', {
//     method: 'POST',
//     headers: {
//       'Content-Type': 'application/json;charset=utf-8',
//       'X-CSRF-TOKEN': token.content,
//     },
//     body: JSON.stringify({'hash': hash})
//   })
//   .then(res => res.json())
//   .then(res => {
//     if (!res.ok) {
//       throw new Error(res.error);
//     }
//     return res;
//   })
//   .catch(err => console.log(err));

// })();
