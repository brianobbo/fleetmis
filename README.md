# Fleet Management System

A comprehensive Laravel-based fleet management system for managing vehicles, drivers, and assignments.

## Features

### Phase 1: Vehicle Management
- **Vehicle Registration**: Add and manage vehicle information including registration number, make/model, year, fuel type, etc.
- **Vehicle Status Tracking**: Track vehicle status (Active, Inactive, Repair)
- **Document Management**: Store and manage vehicle documents (logbook, insurance, etc.)
- **Search & Filter**: Advanced search and filtering capabilities

### Phase 2: Driver Management
- **Driver Profiles**: Complete driver information management
- **License Tracking**: Track driver licenses with expiry dates and classes
- **Contact Management**: Store driver contact information
- **Status Management**: Track driver status (Active, Inactive, On Leave)

### Phase 3: Assignment Management
- **Driver-Vehicle Assignments**: Assign drivers to vehicles
- **Assignment Types**: Support for both permanent and temporary assignments
- **Assignment History**: Track assignment history and changes
- **Conflict Prevention**: Prevent double assignments

## Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd fleetmis
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database configuration**
   - Update your `.env` file with database credentials
   - Create a MySQL database named `fleetmis`

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Start the development server**
   ```bash
   php artisan serve
   ```

## Database Schema

### Vehicles Table
- `id` - Primary key
- `registration_number` - Unique vehicle registration
- `make_model` - Vehicle make and model
- `year_of_manufacture` - Manufacturing year
- `fuel_type` - Petrol, Diesel, Hybrid, Electric
- `odometer_reading` - Current mileage
- `engine_number` - Engine serial number
- `chassis_number` - Chassis serial number
- `insurance_expiry_date` - Insurance expiry
- `service_interval` - Service frequency
- `vehicle_status` - Active, Inactive, Repair
- `document_uploads` - JSON field for file paths
- `created_at`, `updated_at` - Timestamps

### Drivers Table
- `id` - Primary key
- `driver_id` - Auto-generated unique ID (D00001, D00002, etc.)
- `full_name` - Driver's full name
- `national_id_no` - National identification number
- `license_number` - Driving license number
- `license_class` - B, CM, DL
- `license_expiry` - License expiry date
- `contact_number` - Phone number
- `assigned_vehicle_id` - Foreign key to vehicles table
- `status` - Active, Inactive, On Leave
- `created_at`, `updated_at` - Timestamps

### Driver Assignments Table
- `id` - Primary key
- `driver_id` - Foreign key to drivers table
- `vehicle_id` - Foreign key to vehicles table
- `assignment_type` - Permanent, Temporary
- `start_date` - Assignment start date
- `end_date` - Assignment end date (nullable for permanent)
- `remarks` - Additional notes
- `created_at`, `updated_at` - Timestamps

## Usage

### Dashboard
- View system overview and statistics
- Quick access to all major functions
- Recent activity tracking

### Vehicle Management
1. Navigate to "Vehicles" in the main menu
2. Click "Add Vehicle" to register a new vehicle
3. Fill in all required vehicle information
4. Use search and filters to find specific vehicles
5. Click on a vehicle to view detailed information

### Driver Management
1. Navigate to "Drivers" in the main menu
2. Click "Add Driver" to create a new driver profile
3. Fill in driver information including license details
4. Optionally assign a vehicle during creation
5. Use search to find specific drivers

### Assignment Management
1. Navigate to "Assignments" in the main menu
2. Click "New Assignment" to create an assignment
3. Select driver and vehicle from dropdowns
4. Choose assignment type (Permanent/Temporary)
5. Set start and end dates
6. Add any remarks

## API Endpoints

### Driver Details API
```
GET /api/drivers/{driver}/details
```
Returns driver information in JSON format for use in assignment forms.

## Features in Detail

### Search and Filtering
- **Vehicles**: Search by registration, make/model, engine number, chassis number
- **Filter by**: Status, fuel type
- **Drivers**: Search by name, driver ID, license number
- **Filter by**: Status, license class

### Validation
- **Unique Constraints**: Registration numbers, license numbers, national IDs
- **Date Validation**: License expiry dates, assignment dates
- **Assignment Conflicts**: Prevents double assignments
- **Required Fields**: All critical information is required

### User Interface
- **Responsive Design**: Works on desktop and mobile devices
- **Bootstrap 5**: Modern, clean interface
- **Font Awesome Icons**: Intuitive iconography
- **Real-time Feedback**: Success/error messages

## Future Enhancements

The system is designed to be extensible for additional phases:

### Phase 4: Trip & Fuel Management
- Trip logging and tracking
- Fuel consumption monitoring
- Route optimization

### Phase 5: Maintenance & Repairs
- Service scheduling
- Maintenance history
- Repair tracking

### Phase 6: Accounting & Reporting
- Cost tracking
- Financial reports
- Analytics dashboard

## Technical Details

- **Framework**: Laravel 11
- **Database**: MySQL
- **Frontend**: Bootstrap 5, Font Awesome
- **PHP Version**: 8.1+
- **Architecture**: MVC pattern

## Support

For support or questions, please contact the development team.

## License

This project is proprietary software. All rights reserved.