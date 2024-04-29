window.addEventListener("DOMContentLoaded", () => {
    // update circle when range change
    const pie = document.querySelectorAll(".pie");
    const range = document.querySelector('[type="range"]');
  
    range.addEventListener("input", (e) => {
      pie.forEach((el, index) => {
        const options = {
          index: index + 1,
          percent: e.target.value
        };
        circle.animationTo(options);
      });
    });
  
    // start the animation when the element is in the page view
    const elements = [].slice.call(document.querySelectorAll(".pie"));
    const circle = new CircularProgressBar("pie");
  
    // circle.initial();
  
    if ("IntersectionObserver" in window) {
      const config = {
        root: null,
        rootMargin: "0px",
        threshold: 0.75
      };
  
      const ovserver = new IntersectionObserver((entries, observer) => {
        entries.map((entry) => {
          if (entry.isIntersecting && entry.intersectionRatio > 0.75) {
            circle.initial(entry.target);
            observer.unobserve(entry.target);
          }
        });
      }, config);
  
      elements.map((item) => {
        ovserver.observe(item);
      });
    } else {
      elements.map((element) => {
        circle.initial(element);
      });
    }
  
    setInterval(() => {
      const typeFont = [100, 200, 300, 400, 500, 600, 700];
      const colorHex = `#${Math.floor((Math.random() * 0xffffff) << 0).toString(
        16
      )}`;
      const options = {
        index: 17,
        percent: Math.floor(Math.random() * 100 + 1),
        colorSlice: colorHex,
        fontColor: colorHex,
        fontSize: `${Math.floor(Math.random() * (1.4 - 1 + 1) + 1)}rem`,
        fontWeight: typeFont[Math.floor(Math.random() * typeFont.length)]
      };
      circle.animationTo(options);
    }, 3000);
  
    // global configuration
    const globalConfig = {
      speed: 30,
      animationSmooth: "1s ease-out",
      strokeBottom: 5,
      colorSlice: "#FF6D00",
      colorCircle: "#f1f1f1",
      round: true
    };
  
    const global = new CircularProgressBar("global", globalConfig);
    global.initial();
  
    // update global example when change range
    const pieGlobal = document.querySelectorAll(".global");
    range.addEventListener("input", (e) => {
      pieGlobal.forEach((el, index) => {
        const options = {
          index: index + 1,
          percent: e.target.value
        };
        global.animationTo(options);
      });
    });
  
    document.querySelectorAll("pre code").forEach((el) => {
      hljs.highlightElement(el);
    });
  
    const infoCode = document.querySelectorAll(".info-code");
    infoCode.forEach((info) => {
      info.addEventListener("click", (e) => {
        e.target.closest("section").classList.toggle("show-code");
      });
    });
  });
  