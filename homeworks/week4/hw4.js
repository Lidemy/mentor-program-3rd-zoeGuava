const request = require('request');

request.get(
  {
    url: 'https://api.twitch.tv/helix/games/top',
    headers: {
      'Client-ID': 'jblklxorhv6eazmwd01xmzvmmwd2jl',
    },
  },
  (error, response, body) => {
    const gameList = JSON.parse(body).data;
    for (let i = 0; i < gameList.length; i += 1) {
      console.log(`${gameList[i].id} ${gameList[i].name}`);
    }
  },
);
