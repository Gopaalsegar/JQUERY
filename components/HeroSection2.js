import React, { useState, useEffect } from 'react';
import styles from '../styles/HeroSection2.module.css';
import OvalButton from './OvalButton';

const HeroSection2 = ({ backgroundImage, content }) => {
  const [scrollDirection, setScrollDirection] = useState('down');

  useEffect(() => {
    let lastScrollTop = window.pageYOffset || document.documentElement.scrollTop;

    const handleScroll = () => {
      const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      if (scrollTop > lastScrollTop) {
        setScrollDirection('down');
      } else {
        setScrollDirection('up');
      }
      lastScrollTop = scrollTop;
    };

    window.addEventListener('scroll', handleScroll);

    return () => {
      window.removeEventListener('scroll', handleScroll);
    };
  }, []);

  return (
    <section className={styles.hero} style={{ backgroundImage: `url(${backgroundImage})` }}>
      <div className={styles.content}>
        <div className={`${styles.left} ${scrollDirection === 'down' ? styles.zoomIn : styles.zoomOut}`}>
          <div className={styles.textContent}>
            <h2>{content.title}</h2>
            <h1>{content.heading}</h1>
            <p>{content.paragraph}</p>
            <OvalButton text={content.buttonText} />
          </div>
        </div>
      </div>
    </section>
  );
};

export default HeroSection2;
