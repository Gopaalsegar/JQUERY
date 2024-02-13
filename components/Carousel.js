import React, { useState, useRef } from 'react';

const Carousel = () => {
  const carouselContainerRef = useRef(null);
  const carouselRef = useRef(null);
  const [isDragging, setIsDragging] = useState(false);
  const [startPosition, setStartPosition] = useState(0);
  const [currentTranslate, setCurrentTranslate] = useState(0);

  const handleMouseDown = (e) => {
    setIsDragging(true);
    setStartPosition(e.clientX - carouselContainerRef.current.offsetLeft);
  };

  const handleMouseMove = (e) => {
    if (!isDragging) return;

    const currentPosition = e.clientX - carouselContainerRef.current.offsetLeft;
    const translate = currentPosition - startPosition + currentTranslate;

    carouselRef.current.style.transform = `translateX(${translate}px)`;
  };

  const handleMouseUp = () => {
    setIsDragging(false);
    setCurrentTranslate(parseInt(carouselRef.current.style.transform) || 0);
  };

  const handleMouseLeave = () => {
    setIsDragging(false);
    setCurrentTranslate(parseInt(carouselRef.current.style.transform) || 0);
  };

  return (
    <div id="carousel-container" ref={carouselContainerRef} style={{ overflow: 'hidden', width: '300px', margin: '20px auto', position: 'relative' }}>
      <div id="carousel" ref={carouselRef}
        onMouseDown={handleMouseDown}
        onMouseMove={handleMouseMove}
        onMouseUp={handleMouseUp}
        onMouseLeave={handleMouseLeave}
        style={{ display: 'flex', transition: 'transform 0.3s ease-in-out' }}
      >
        <div className="carousel-item" style={{ minWidth: '300px', boxSizing: 'border-box', padding: '10px', border: '1px solid #ddd', marginRight: '10px' }}>Image 1</div>
        <div className="carousel-item" style={{ minWidth: '300px', boxSizing: 'border-box', padding: '10px', border: '1px solid #ddd', marginRight: '10px' }}>Image 2</div>
        <div className="carousel-item" style={{ minWidth: '300px', boxSizing: 'border-box', padding: '10px', border: '1px solid #ddd', marginRight: '10px' }}>Image 3</div>
        <div className="carousel-item" style={{ minWidth: '300px', boxSizing: 'border-box', padding: '10px', border: '1px solid #ddd', marginRight: '10px' }}>Image 4</div>
        {/* Add more items as needed */}
      </div>
    </div>
  );
};

export default Carousel;
