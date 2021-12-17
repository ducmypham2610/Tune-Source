"use strict";
const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);


const player = $('.player');
const heading = $('.player__name');
const cdThumb = $('.player__cd-thumb');
const audio = $('#audio');
const progress = $('#progress');
const playBtn = $('.btn-toggle-play');
const nextBtn = $('.btn-next');
const prevBtn = $('.btn-prev');
const randomBtn = $('.btn-random');
const repeatBtn = $('.btn-repeat');
const playlist = $('.top__chart');

const app = {
  currentIndex: 0,
  isPlaying: false,
  isRandom: false,
  isRepeat: false,
  songs: [
    {
      name: "Mistletoe",
      singer: "Justin Bieber",
      path: "./music/song1.mp3",
      img: "./img/img1.jpg",
    },
    {
      name: "Save your tears",
      singer: "The Weeknd",
      path: "./music/song2.mp3",
      img: "./img/theweeknd.jpg",
    },
    {
      name: "Blank Space",
      singer: "Taylor Swift",
      path: "./music/song3.mp3",
      img: "./img/taylorswift.jpg",
    },
    {
      name: "Thunder",
      singer: "Imagine Dragons",
      path: "./music/song4.mp3",
      img: "./img/Imagine.jpg",
    },
    {
      name: "Blinding Lights",
      singer: "The Weeknd",
      path: "./music/song5.mp3",
      img: "./img/theweeknd.jpg",
    },
    {
      name: "Last Christmas",
      singer: "Ariana Grande",
      path: "./music/song6.mp3",
      img: "./img/ariana.jpg",
    },
  ],
  defineProperties: function () {
    Object.defineProperty(this, "currentSong", {
      get: function () {
        return this.songs[this.currentIndex];
      },
    });
  },
  render: function () {
    const htmls = this.songs.map((song, index) => {
      return `<div class="song ${index === this.currentIndex ? 'active' : ''}" data-index = "${index}">
          <div class="thumb"
              style="background-image: url('${song.img}')">
          </div>
          <div class="body">
              <h3 class="title"><a href="#" class = "link">${song.name}<a></h3>
              <p class="author"><a href="#" class = "link">${song.singer}<a></p>
          </div>
          <div class="option">
              <i class="fas fa-ellipsis-h"></i>
          </div>
      </div>
      `;
    });
    playlist.innerHTML = htmls.join("");
  },
  handleEvents: function() {
    const _this = this;

    // Rotate CD
    const cdThumbAnimate = cdThumb.animate([{transform: 'rotate(360deg)'}], {
      duration: 10000,
      iterations: Infinity,
    })
    cdThumbAnimate.pause();

    // Click play
    playBtn.onclick = function() {
      if (_this.isPlaying) {
        audio.pause();
      } else {      
        audio.play(); 
      }
    }
    //When song is played
    audio.onplay = function() {
      _this.isPlaying = true;
      cdThumbAnimate.play();
      player.classList.add('playing');
    }

    // When song is paused
    audio.onpause = function() {
      _this.isPlaying = false;
      cdThumbAnimate.pause();
      player.classList.remove('playing');
    }

    // When song is on process
    audio.ontimeupdate = function() {
      if(audio.duration) {
        const progressPercent = Math.floor((audio.currentTime / audio.duration * 100));
        progress.value = progressPercent;
      }
    }

    // Change the current time of the song
    progress.onchange = function(e) {
      const seekTime = audio.duration / 100 * e.target.value;
      audio.currentTime = seekTime;
    }
    
    // next song
    nextBtn.onclick = function() {
      if (_this.isRandom) {
        _this.playRandomSong();
      } else {
        _this.nextSong();
      } 
      audio.play();
      _this.render();
    }

    // prev song
    prevBtn.onclick = function() {
      if (_this.isRandom) {
        _this.playRandomSong();
      } else {
      _this.prevSong();
      }
      audio.play();
      _this.render();
    }

    // random song
    randomBtn.onclick = function() {
      _this.isRandom = !_this.isRandom;
      randomBtn.classList.toggle('active', _this.isRandom);
    }

    // repeat song
    repeatBtn.onclick = function(e) {
      _this.isRepeat = !_this.isRepeat;
      repeatBtn.classList.toggle('active', _this.isRepeat);
    }

    // move to next song when the song is ended
    audio.onended = function() {
      if(_this.isRepeat) {
        audio.play();
      } else {
        nextBtn.click();
      }
    }

    // Click song to play
    playlist.onclick = function (e) {
      const songNode = e.target.closest('.song:not(.active)');
      // Click on another song
      if (songNode || e.target.closest('.option')) {
        if (songNode) {
          _this.currentIndex = Number(songNode.dataset.index);
          _this.loadCurrentSong();
          _this.render();
          audio.play();
        }
      }
    }

  },
  loadCurrentSong: function () {
    heading.textContent = this.currentSong.name;
    cdThumb.style.backgroundImage = `url('${this.currentSong.img}')`;
    audio.src = this.currentSong.path;
  },
  nextSong: function() {
    this.currentIndex++;
    if (this.currentIndex >= this.songs.length) {
      this.currentIndex = 0;
    }
    this.loadCurrentSong();
  },
  prevSong: function() {
    this.currentIndex--;
    if(this.currentIndex < 0) {
      this.currentIndex = this.songs.length - 1
    }
    this.loadCurrentSong();
  },
  playRandomSong: function() {
      let newIndex;
      do {
        newIndex = Math.floor(Math.random() * this.songs.length)
      } while (newIndex === this.currentIndex)

      this.currentIndex = newIndex;
      this.loadCurrentSong();
    
  },
  start: function () {
    // Define Properties for Objects
    this.defineProperties();

    // Handle events
    this.handleEvents();

    // Load the information of the first song
    this.loadCurrentSong();

    // List of songs
    this.render();
  },
};

app.start();
