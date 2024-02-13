import React, { useState, useEffect } from 'react';
import styles from '../styles/ImageSection.module.css';
import OvalButton from './OvalButton';

const ImageSection = ({ backgroundImage, heading, content, buttonText }) => {
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
    <section className={styles.imageSection} style={{ backgroundImage: `url(${backgroundImage})` }}>
      <div className={`${styles.content} ${scrollDirection === 'up' ? styles.slideOut : styles.slideIn}`}>
        <div className={styles.left}>
          <h2>{heading}</h2>
          <p>{content}</p>
        </div>
        <div className={styles.right}>
        <button className={styles.button}>Schedule a Call</button>
        </div>
      </div>
    </section>
  );
};

export default ImageSection;
