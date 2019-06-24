const request = new XMLHttpRequest();

const container = document.querySelector('.container');
const bg = document.querySelector('.bg');
const content = document.querySelector('.content');
const firstBg = 'linear-gradient(to right, rgba(255, 255, 255, .3),  rgba(255, 255, 255, .3))';
const firstImg = 'url(http://www.freepngclipart.com/download/airplane/78077-the-flying-plane-aircraft-vector-in-airplane.png)';
const secondBg = '#e7e7e7';
const secondImg = 'url(http://koksalaltay.club/wp-content/uploads/2019/01/inch-stand-cm-tall-90-tv-ranallo-stands-oak.jpg)';
const thirdBg = 'linear-gradient(to right, rgba(30, 75, 115, 1),  rgba(255, 255, 255, 0))';
const thirdImg = 'url(https://www.stickpng.com/assets/images/580b57fcd9996e24bc43c548.png)';
const noneBg = '#000';
const noneImg = '#fff';
const alert = '系統不穩定，請再試一次';

function rewardFirst() {
  content.innerText = `恭喜你中頭獎了！
  日本東京來回雙人遊！`;
  document.querySelector('.wrapper').style.backgroundImage = 'url(https://images.pexels.com/photos/301614/pexels-photo-301614.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940)';
  container.style.backgroundColor = firstBg;
  bg.style.backgroundImage = firstImg;
  bg.style.backgroundPosition = 'center';
}

function rewardSecond() {
  content.innerText = `二獎！
  90 吋電視一台！`;
  container.style.backgroundColor = secondBg;
  bg.style.backgroundImage = secondImg;
}

function rewardThird() {
  content.innerText = `恭喜你抽中三獎：
  知名 YouTuber 簽名握手會入場券一張，bang！`;
  container.style.backgroundImage = thirdBg;
  bg.style.backgroundImage = thirdImg;
}

function rewardNone() {
  content.innerText = '銘謝惠顧';
  container.style.backgroundColor = noneBg;
  container.style.color = noneImg;
}

// function rewardError() {
//   alert('系統不穩定，請再試一次');
//   location.reload();
// }


request.onload = () => {
  if (request.status >= 200 && request.status < 400) {
    const response = request.responseText;
    const json = JSON.parse(response);
    const reward = json.prize;
    switch (reward) {
      case 'FIRST':
        // console.log('恭喜你中頭獎了！日本東京來回雙人遊！');
        rewardFirst();
        break;
      case 'SECOND':
        // console.log('二獎！90 吋電視一台！');
        rewardSecond();
        break;
      case 'THIRD':
        // console.log('恭喜你抽中三獎：知名 YouTuber 簽名握手會入場券一張，bang！');
        rewardThird();
        break;
      case 'NONE':
        // console.log('銘謝惠顧');
        rewardNone();
        break;
      default:
        alert(alert);
        break;
    }
  } else {
    alert(alert);
  }
};

request.open('GET', 'https://dvwhnbka7d.execute-api.us-east-1.amazonaws.com/default/lottery', true);
request.send();
