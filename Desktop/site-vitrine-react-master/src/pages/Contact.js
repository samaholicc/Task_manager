import React from "react";
import ContactForm from "../components/ContactForm";
import Logo from "../components/Logo";
import Mouse from "../components/Mouse";
import Navigation from "../components/Navigation";
import CopyToClipbord from "react-copy-to-clipboard";
import SocialNetwork from "../components/SocialNetwork";
import Button from "../components/Button";
import { motion } from "framer-motion";

const Contact = () => {
  const pageTransition = {
    in: {
      opacity: 1,
      x: 0,
    },
    out: {
      opacity: 0,
      x: 300,
    },
  };

  return (
    <main>
      <Mouse />
      <motion.div
        className="contact"
        exit="out"
        animate="in"
        initial="out"
        variants={pageTransition}
        transition={{ duration: 0.5 }}
      >
        <Navigation />
        <Logo />
        <ContactForm />
        <div className="contact-infos">
          <div className="adress">
            <div className="content">
              <h4>Adresse</h4>
              <p>XX, Rue Haoues</p>
              <p>XX, France </p>
            </div>
          </div>

          <div className="phone">
            <div className="content">
              <h4>Téléphone</h4>
              <p></p>
              <CopyToClipbord text="01 11 11 11 11" className="hover">
                <p
                  style={{ cursor: "pointer" }}
                  className="clipboard"
                  onClick={() => alert("télephone copié !")}
                >
                  061 45 47 47
                </p>
              </CopyToClipbord>
            </div>
          </div>

          <div className="email">
            <div className="content">
              <h4>Email</h4>
              <CopyToClipbord text="boutezroutsamia@gmail.com" className="hover">
                <p
                  style={{ cursor: "pointer" }}
                  className="clipboard"
                  onClick={() => alert("E-mail copié !")}
                >
                  boutezroutsamia@gmail.com
                </p>
              </CopyToClipbord>
            </div>
          </div>
          <SocialNetwork />
          <div className="credits">
            <p>Henni Abdellah - 2023</p>
          </div>
        </div>
        <Button left="/projet4" />
      </motion.div>
    </main>
  );
};

export default Contact;
