feather.replace();

const controls = document.querySelector('.controls');
const cameraOptions = document.querySelector('.video-options>select');
const video = document.querySelector('video');
const canvas = document.querySelector('canvas');
const screenshotImage = document.querySelector('#screenshot-image');
const buttons = [...controls.querySelectorAll('button')];
let streamStarted = false;
const showBtn = document.getElementById('show-plant-info-btn');
const hideBtn = document.getElementById('hide-plant-info-btn');
const plantInfo = document.getElementById('plant-info');

const [play, pause, screenshot] = buttons;

const constraints = {
  video: {
    width: {
      min: 1280,
      ideal: 1920,
      max: 2560,
    },
    height: {
      min: 720,
      ideal: 1080,
      max: 1440
    },
  }
};

const getCameraSelection = async () => {
  const devices = await navigator.mediaDevices.enumerateDevices();
  const videoDevices = devices.filter(device => device.kind === 'videoinput');
  const options = videoDevices.map(videoDevice => {
    return `<option value="${videoDevice.deviceId}">${videoDevice.label}</option>`;
  });
  cameraOptions.innerHTML = options.join('');
};

play.onclick = () => {
  if (streamStarted) {
    video.play();
    play.classList.add('d-none');
    pause.classList.remove('d-none');

    return;
  }
  if ('mediaDevices' in navigator && navigator.mediaDevices.getUserMedia) {
    const updatedConstraints = {
      ...constraints,
      deviceId: {
        exact: cameraOptions.value
      }
    };
    startStream(updatedConstraints);
  }
};
const startStream = async (constraints) => {
  const stream = await navigator.mediaDevices.getUserMedia(constraints);
  handleStream(stream);
};

const handleStream = (stream) => {
  video.srcObject = stream;
  play.classList.add('d-none');
  pause.classList.remove('d-none');
  screenshot.classList.remove('d-none');
  streamStarted = true;
};

getCameraSelection();
cameraOptions.onchange = () => {
  const updatedConstraints = {
    ...constraints,
    deviceId: {
      exact: cameraOptions.value
    }
  };
  startStream(updatedConstraints);
};

const pauseStream = () => {
  video.pause();
  play.classList.remove('d-none');
  pause.classList.add('d-none');
};

const doScreenshot = () => {
  canvas.width = video.videoWidth;
  canvas.height = video.videoHeight;
  canvas.getContext('2d').drawImage(video, 0, 0);
  screenshotImage.src = canvas.toDataURL('image/webp');/**/
  screenshotImage.classList.remove('d-none');
  document.querySelector("#save").classList.remove("display-no")


};

$("#save").click(function ()  {

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) {
  $.ajax({
     type: "POST",
     url: 'apiphoto',
     dataType: 'text',
     data:  {
    image : canvas.toDataURL('image/webp'),
    plant:  document.getElementById('plant-title').innerHTML,
    longitude: position.coords.longitude,
    latitude: position.coords.latitude,
    },
    success: function(d){
      d=JSON.parse(d)
      document.getElementById("fiche-reussite").innerHTML=`<h2>Félicitation tu as découvert une nouvelle plante: ${d.plantName}</h2><img style="margin-bottom:5%;" src="/images/photo/${d.filename}"/>${d.fichePlanteAfter}` ; 
      document.getElementById("fiche-reussite").classList.remove("hidden-top");
    }
  });
})
} 
});

function afficherPlante(){
  showBtn.classList.add("display-no");
  hideBtn.classList.remove("display-no");
  plantInfo.classList.remove("hidden-left");
  plantInfo.classList.add("left-0");
}
function cacherPlante(){
  hideBtn.classList.add("display-no");
  showBtn.classList.remove("display-no");
  plantInfo.classList.add("hidden-left");
  plantInfo.classList.remove("left-0");
}
pause.onclick = pauseStream;
screenshot.onclick = doScreenshot;
