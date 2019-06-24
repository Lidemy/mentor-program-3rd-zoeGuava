const request = new XMLHttpRequest();
const list = document.querySelector('.list');

request.onload = () => {
  if (request.status >= 200 && request.status < 400) {
    const json = JSON.parse(request.responseText);
    console.log(json);
    for (let i = 0; i < json.streams.length; i += 1) {
      const container = document.createElement('div');
      const channelPreview = json.streams[i].preview.medium;
      const channelLink = json.streams[i].channel.url;
      const channelLogo = json.streams[i].channel.logo;
      const channelTitle = json.streams[i].channel.status;
      const channelName = json.streams[i].channel.name;
      container.classList.add('row');
      container.innerHTML = `
      <a href="${channelLink}" target="_blnak"><img class="channelPreview" src="${channelPreview}" alt=""></a>
      <div class="channelContainer">
        <img class="channelLogo" src="${channelLogo}" alt="">
        <div class="channelData">
          <div class="channelTitle">${channelTitle}</div>
          <div class="channelName">${channelName}</div>
        </div>
      </div>
      `;
      list.appendChild(container);
      console.log(channelTitle);
    }
  }
  console.log(request.status);
};

request.open('GET', 'https://api.twitch.tv/kraken/streams/?game=League of Legends&limit=20', true);
request.setRequestHeader('Client-ID', 'jblklxorhv6eazmwd01xmzvmmwd2jl');
request.send();
