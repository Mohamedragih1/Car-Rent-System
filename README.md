# Car Rental System

## Project Overview:
This project implements a Car Rental System with the following features:

- Registration and status update for new cars.
- Global car reservation system for customers.
- Customer account creation and reservation process.
- Automated procedures for car reservation (reserve, pick up, return, payment, etc.).
- Advanced search for available cars based on various criteria.
- System reports, including reservations within a specified period, car reservations, status of all cars on a specific day, and more.

## Pages:
### Home Page
- Brief introduction to the Car Rental System.
- Buttons for LOGIN, SIGN-UP, and ADMIN.

### Log-In Page
- User authentication with email and password.
- Redirects to customer page upon successful login.

### Sign-Up Page
- User registration with personal information.
- User data stored, including Email, Password, Name, Surname, and Date of Birth.

### Customer Pages:
1. **Search for a Car**
   - Criteria input for location, model, year, brand, mileage, and price.
   - Displays a table of cars matching the criteria.
   - Provides additional privileges: view reservation history, delete account.

2. **Make Reservation**
   - Specifications of the selected car, invalid dates, pick-up date, return date, OK button.
   - Confirmation or cancellation of the reservation.

### Admin Pages:
1. **Admin Home Page**
   - Buttons for various admin privileges.
   - Logout button to log out from the admin account.

2. **Show All Reservations**
   - Input for start and end dates.
   - Displays a table of all reservations within the specified period.

3. **Show Specific Car Reservations**
   - Dropdown menu to select a car.
   - Input for start and end dates.
   - Displays reservations for the selected car.

4. **Show Specific User Reservations**
   - Dropdown menu to select a user.
   - Input for start and end dates.
   - Displays reservations for the selected user.

5. **Add Car**
   - Input fields for car specifications (Plate ID, Model, Year, Brand, Mileage, Price per day, Color, Office ID).
   - Adds the new car to the system.

6. **Change Car Status**
   - Dropdown menus to select the car and its new status.
   - Continue button to update the status.

7. **Show Status of All Cars**
   - Input for a specific date.
   - Displays a table of all cars with their statuses on that date.

8. **Daily Payments**
   - Input for start and end dates.
   - Displays a table of daily payments within the specified period.
