# Quikbooks - Full-Stack E-Book Rental Service System

**Description**  
Quikbooks is a web-based, full-stack digital publishing application designed as a sustainable, cost-effective alternative to physical libraries. Driven by a competitive analysis of subscription models, the system implements an agile, transactional per-book rental mechanic. The platform utilizes a split-role ecosystem separating user customer flows from granular backend administrative controls.

**Tech Stack**  
* **Backend & Database:** MySQL (Relational Database Management)[cite: 2]
* **Frontend:** HTML5, CSS3, JavaScript (ES6+)[cite: 2]
* **Integrations:** Stripe Payment Gateway API[cite: 2]
* **Architecture Modeling:** Context Diagrams, Data Flow Diagrams (DFD), Entity-Relationship Diagrams (ERD)[cite: 2]

**Key Responsibilities & Contributions**  
* **System Architecture Design:** Architected the global logic flows of the application, producing the core Context Diagrams and layered Data Flow Diagrams (DFD) to define process boundaries[cite: 2].
* **Full-Stack Engineering:** Co-developed application features, implementing server-side logical validations and ensuring robust data handling[cite: 2].
* **System Testing:** Managed rigorous system components testing and bug-remediation processes to ensure cross-module stability[cite: 2].

**Key Features & Technical Highlights**  
* **Dual-Module Architecture:** Built distinct execution flows for Customers (browsing, interactive shopping cart, order processing) and Administrators (book inventories management, transactional logging, user management)[cite: 2].
* **Relational Database Design:** Normalized a 7-table MySQL schema (`Users`, `Books`, `Rental`, `Payment`, `Reports`, `ShoppingCart`, `Contact`) utilizing structured primary/foreign key pairings to preserve integrity across accounts and assets[cite: 2].
* **Transactional Security:** Structured multi-stage validation routes for checking out digital inventory, integrating with secure payment pipelines (Stripe API) to process transactions safely[cite: 2].
* **Business Analytics Engine:** Engineered a specialized reporting suite in the staff portal to generate automated financial records, transaction summaries, and system performance updates[cite: 2].

**Database Architecture Schema Overview**  
* `Users`: Management of authentication, profile attributes, and role privileges[cite: 2].
* `Books`: Central repository holding descriptive metadata, target tags, and sample data[cite: 2].
* `Rental` & `Payment`: Core ledger logging transactional states, rental lifecycles, and pricing parameters[cite: 2].

**Getting Started**  

*Prerequisites*  
* Local environment server stack (XAMPP / WAMP / WCODE)[cite: 2]
* Web Browser (Chrome, Firefox, Edge, or Safari)[cite: 2]

*Installation*  
1. Clone the repository:
```bash
   git clone [https://github.com/yourusername/Quikbooks-Ebook-Rental-System.git](https://github.com/yourusername/Quikbooks-Ebook-Rental-System.git)
