// components/BlackBox.js
import React, { useState, useEffect } from 'react';
import styles from '../styles/BlackBox.module.css';
import OvalButton from './OvalButton';

const BlackBox = ({ heading, content, buttonText }) => {
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
    <div className={`${styles.blackBox} ${scrollDirection === 'up' ? styles.zoomOut : styles.zoomIn}`}>
      <div className={styles.center}>
        <h2>{heading}</h2>
        <p>{content}</p>
        <OvalButton text={buttonText} />
      </div>
    </div>
  );
};

export default BlackBox;
